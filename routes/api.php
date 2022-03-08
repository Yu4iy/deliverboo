<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')
				->group(function(){
					Route::get('/restaurants/{slug}', 'RestaurantController@index');
					Route::get('/menu/{slug}', 'RestaurantController@show');
					Route::get('/bestRestaurants', 'RestaurantController@bestRestaurants');
					Route::get('/category', 'RestaurantController@CategoryRestaurant');
					// Route::get('/menu/{slug}', 'RestaurantController@getDishes');
					
				});
