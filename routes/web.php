<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

			//dishes cruds
			Route::resource('/dishes', 'DishController');

			// trash
			Route::get('/trash', 'DishController@getTrash')->name('dishes.trash');

    
			Route::match(['get', 'post'], '/restore/{id}', 'DishController@restore')->name('dishes.restore');
			
			Route::match(['get', 'delete'], '/delete/{id}', 'DishController@forceDelete')->name('dishes.forceDelete');
	});

// Route::match(['get', 'post'], '/checkout', 'CheckoutController@index')->name('checkout');
Route::get("{any?}", function() {
	return view('guests.home');
})->where('any', '.*');