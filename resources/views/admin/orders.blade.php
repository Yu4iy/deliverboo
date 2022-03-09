@extends('layouts.app')

@section('content')
    @foreach ($orders as $order )
        <pre>
            Email: {{ $order->customer_email }}
            Address: {{ $order->customer_address}}
            Phone: {{ $order->customer_phone }}
        </pre>
        @foreach ($order->dishes as $dish )
            <pre>
                Dish name: {{ $dish->name}}
                Quantity: {{ $dish->pivot->quantity}}
            </pre>
        @endforeach
    @endforeach
@endsection