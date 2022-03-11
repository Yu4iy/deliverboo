<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Braintree;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\User;

/* Email di Conferma */
use App\Mail\SendConfirmedOrderEmail;
use App\Mail\SendToRestaurantOrderEmail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index() {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.enviroment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);
        $token = $gateway->ClientToken()->generate();
        return response()->json($token);
    }

    public function sendOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_name' =>'required|max:50',
            'customer_lastname' =>'required|max:50',
            'customer_email' =>'required|email',
            'customer_phone' =>'required|numeric|regex:/^[+]*[0-9]{10,13}$/',
            'customer_address' => 'required|regex:/^[A-Za-z]{1,}+[,\s]+(([A-Za-z]+[.\s]+)*[A-Za-z]{1,}+[,\s]+)+[0-9]{1,3}+$/'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $restaurant_id = $request->dishes[0]['user_id'];
        $restaurant = User::where('id', $restaurant_id)->first();
        /* $restaurant_email = $restaurant->email; */
        $amount = 0;
        foreach($request->dishes as $dish) {
            $amount += ($dish['price'] * $dish['quantity']);
        }
       /*  $amount = $request->amount; */
        $nonce = $request->payment_method_nonce;

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.enviroment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {

            $transaction = $result->transaction;

            //Register new Order in DB
            $new_order = new Order();
            $new_order->order_code = $transaction->id;
            $new_order->customer_name = $request->customer_name;
            $new_order->customer_lastname = $request->customer_lastname;
            $new_order->customer_email = $request->customer_email;
            $new_order->customer_phone = $request->customer_phone;
            $new_order->customer_address = $request->customer_address;

            if($request->notes) {
                $new_order->notes = $request->notes;
            }
            $new_order->total_price = $amount;

            $new_order->save();
            
            
            $order_id = Order::all()->last()->id;
            foreach($request->dishes as $item) {
                DB::table('dish_order')->insert([
                    'dish_id' => $item['id'],
                    'order_id' => $order_id,
                    'quantity' => $item['quantity'],
                ]);
            }
            
            /* MailTrap */
            Mail::to($request->customer_email)
            /* later(now()->addSeconds(5), new SendConfirmedOrderEmail()); */
            ->send(new SendConfirmedOrderEmail($new_order));
            Mail::to($restaurant->email)
            /* later(now()->addSeconds(5), new SendConfirmedOrderEmail()); */
            ->send(new SendToRestaurantOrderEmail($new_order, $restaurant));
    


            return response()->json('Transazione avvenuta correttamente!');
        } else {
            $errorString = "";
    
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            /* $_SESSION["errors"] = $errorString;
            header("Location: index.php"); */
    
            return back()->withErrors('Si è verificato un errore: '. $result->message);
        }
    }
}
