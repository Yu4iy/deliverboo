<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
		$total_sales_data = []; //y
		$total_orders_number = []; //y
		
		$data = Order::whereHas('dishes', function(Builder $query) {
			$query->where('user_id', Auth::id());
		})->get()->groupBy(function($item) {
			return Carbon::parse($item->created_at)->format('d/m');
		});
		/* dd($data); */
		$startDate = Carbon::now(); //current day
		$firstday = Carbon::now()->firstOfMonth();
		$from = Carbon::parse($firstday);
		$to = Carbon::parse($startDate);
		$day_labels = [];
		for($d = $from; $d->lte($to); $d->addDay()) {
			$day_labels[] = $d->format('d/m');
		}

		$test = [];
		foreach($data as $key => $item) {
			$test[$key] = $item;
		}

		$orders_number = [];
		foreach($day_labels as $date) {
			if(array_key_exists($date, $test)) {
				$orders_number[$date] = count($test[$date]);
			} else {
				$orders_number[$date] = 0;
			}
		}
		
		foreach($orders_number as $label => $total_orders) {
			$total_orders_number[] = $total_orders;
		}

		$total_sales_array = [];
		foreach($day_labels as $date) {
			if(array_key_exists($date, $test)) {
				$total = 0;
				foreach($test[$date] as $order) {
					$total += $order->total_price;
				}
				$total_sales_array[$date] = $total;
			} else {
				$total_sales_array[$date] = 0;
			}
		}
		foreach($total_sales_array as $label => $total_sales) {
			$total_sales_data[]=$total_sales;
		}
		return view('admin.statistics', compact('total_sales_data', 'day_labels', 'total_orders_number'));
	}
}
