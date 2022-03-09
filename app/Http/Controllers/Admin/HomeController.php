<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		return view('admin.home');
	}

	public function getOrders() {
		$orders = Order::whereHas('dishes', function(Builder $query) {
			$query->where('user_id', Auth::id());
		})->get();
		$orders->load('dishes');
		return view('admin.orders', compact('orders'));
	}


	public function statistics() {
		return view('admin.statistics');
	}
}
