<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dish;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		return view('admin.home');
	}

	public function getOrders() {
		$dishes = Dish::where('user_id', Auth::id())->with('orders');
		dd($dishes);
		return view('admin.orders');
	}
}
