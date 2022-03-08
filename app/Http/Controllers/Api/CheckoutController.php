<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Braintree;
use App\Order;

/* Email di Conferma */
use App\Mail\SendConfirmedOrderEmail;
use App\Mail\SendToRestaurantOrderEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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
        $amount = $request->amount;
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

            /* MailTrap */

            /* TODO bisogna rendere dinamico il TO */
            Mail::to('account@mail.com')->send(new SendConfirmedOrderEmail());
            Mail::to(Auth::user()->email)->send(new SendToRestaurantOrderEmail());

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
            $new_order->total_price = $request->amount;

            $new_order->save();

            $order_id = Order::all()->last()->id;
            foreach($request->dishes as $item) {
                DB::table('dish_order')->insert([
                    'dish_id' => $item['id'],
                    'order_id' => $order_id,
                    'quantity' => $item['quantity'],
                ]);
            }

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
