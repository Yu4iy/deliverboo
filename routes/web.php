<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
	->namespace('Admin')
	->name('admin.')
	->prefix('admin')
	->group(function(){
			//admin home
			Route::get('/', 'HomeController@index')->name('home');

			Route::get('/orders', 'HomeController@getOrders')->name('orders');
			//dishes cruds
			Route::resource('/dishes', 'DishController');

			// trash
			Route::get('/trash', 'DishController@getTrash')->name('dishes.trash');

    
			Route::match(['get', 'post'], '/restore/{id}', 'DishController@restore')->name('dishes.restore');
			
			Route::match(['get', 'delete'], '/delete/{id}', 'DishController@forceDelete')->name('dishes.forceDelete');

			Route::get('/statistics', 'HomeController@statistics')->name('statistics');
	});

/* Route::get('/cart', function() {
	$gateway = new Braintree\Gateway([
		'environment' => config('services.braintree.enviroment'),
		'merchantId' => config('services.braintree.merchantId'),
		'publicKey' => config('services.braintree.publicKey'),
		'privateKey' => config('services.braintree.privateKey'),
	]);
	$token = $gateway->ClientToken()->generate();
	return view('guests.checkout');
})->name('cart'); */

/* Route::post('/checkout', 
function(Request $request) {
	$data = $request->all();
	if($data['dishes']) {
		foreach($data['dishes'] as &$dish) {
			$dish = json_decode($dish);
		}
	} */
	//Register new Order in DB
	/* $new_order = new Order();
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
	dump($order_id);
	foreach($data['dishes'] as $item) {
		dump($item);
		$dish_id = $item->id;
		$quantity = $item->quantity;
		DB::table('dish_order')->insert([
			'dish_id' => $dish_id,
			'order_id' => $order_id,
			'quantity' => $quantity,
		]);
	}

	return redirect()->route('home'); */

	/* $amount = $request->amount;
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
		$new_order->total_price = $request->amount;

		$new_order->save();
		//header("Location: transaction.php?id=" . $transaction->id);
		return back()->with('success_message', 'La transazione è avvenuta con successo. ID transazione: ' . $transaction->id);
		
	} else {
		$errorString = "";

		foreach($result->errors->deepAll() as $error) {
			$errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
		} */

		/* $_SESSION["errors"] = $errorString;
		header("Location: index.php"); */

		/* return back()->withErrors('Si è verificato un errore: '. $result->message);
	}*/
/* }
);  */

Route::get("{any?}", function() {
	return view('guests.home');
})->where('any', '.*');