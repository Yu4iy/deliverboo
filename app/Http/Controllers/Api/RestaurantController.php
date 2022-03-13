<?php

namespace App\Http\Controllers\Api;

use App\Category;
// use App\Dish;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
	public function index($slug)
	{
		$restaurants = Category::where('slug', $slug)->with('users:id,restaurant_name,slug,address,city,iva,description,image,delivery_price')->get();
		return response()->json($restaurants);


	}

	public function show($slug)
	{
		$dishes = User::where('slug', $slug)->select('id', 'restaurant_name', 'slug', 'address', 'city' ,'iva', 'description', 'image', 'delivery_price')->get();
		$dishes->load(['dishes'=>function($elem){
			$elem->where('is_visible', 1);
		}]);
		return response()->json($dishes);
	}
	// public function getDishes($id)
	// {
	// 	$dishInfo = Dish::where('user_id', $id)->where('is_visible', 1)->select('name','slug','ingredients','description','price', 'image')->get();
	// 	return response()->json($dishInfo);

	// }
	
	public function bestRestaurants()
	{
		$bestRestaurants = User::paginate(6);
		return response()->json($bestRestaurants);

	}

	public function CategoryRestaurant()
	{
		$categories = Category::orderBy('name', 'asc')->with('users')->get();
		return response()->json($categories);

	}

}
