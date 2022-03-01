<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
	public function index($slug)
	{
		$restaurants = Category::where('slug', $slug)->with('users')->get();
		return response()->json($restaurants);
	}

	public function show($slug)
	{
		$dishes = User::where('slug', $slug)->with('dishes')->get();
		return response()->json($dishes);
	}
}
