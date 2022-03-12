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

	public function getStatistics() {
		$orders = Order::whereHas('dishes', function(Builder $query) {
			$query->where('user_id', Auth::id());
		})->get();

		

		$day_data = $orders[0];
		$day_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Ju', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
		return view('admin.statistics', compact('day_data', 'day_labels'));
	}
}
