@extends('layouts.app')

@section('content')
    {{-- @foreach ($orders as $order )
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
    @endforeach --}}
    <section class="orders">
        <div class="ordersContainer container">

            {{-- title --}}
            <div class="orderTitileContainer">
                <h1>Lista ordini ricevuti</h1>
            </div>
    
            {{-- order cards --}}
            <div class="ordersCardContainer container-fluid">
                
                <ul class="row">
                    @forelse ( $orders as $order)
                       <li class="ordersCards col-sm-12 col-md-6">
                            <div class="CardContainerBorder">
                                <h5 class="cardTitle">
                                    <i class="fa-solid fa-note-sticky"></i> 
                                    
                                    Codice ordine: 
                                    {{$order->order_code}}
    
                                </h5>
                                <div class="data_ora"><i class="fas fa-calendar-alt"></i>{{$order->created_at}}</div>
    
                               {{-- lista dati --}}
                                <ul class="cardData mt-3 p-1">
                                    {{-- cibo --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-utensils"></i>
                                            <span> Ordine: </span>
                                        </div>

                                        <div class="mx-2 infoData">
                                            @foreach ($order->dishes as $dish)
                                                {{$dish->name}}
                                                <span class="orderQuantity"> x{{ $dish->pivot->quantity}}</span> /
                                            @endforeach
                                        </div>  
                                    </li>

                                    {{-- prezzo totale --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span> Prezzo-totale: </span>
                                        </div>

                                        <div class="mx-2 align-self-center infoData">
                                            {{$order->total_price}} €
                                        </div>  
                                    </li>

                                    {{-- address --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span> Indirizzo-cliente: </span>
                                        </div>

                                        <div class="mx-2 align-self-center infoData">
                                            {{$order->customer_address}}
                                        </div>  
                                    </li>

                                    {{-- note --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle"></i>
                                            <span>Info-utili: </span>
                                        </div>

                                        <div class="mx-2 align-self-center infoData">
                                            @if ($order->notes)
                                               {{$order->notes}}
                                            @else
                                                Nessuna info
                                            @endif  
                                        </div>  
                                    </li>

                                    {{-- email --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-envelope"></i>
                                            <span> Email-cliente: </span>
                                        </div>

                                        <div class="mx-2 align-self-center infoData">
                                            {{$order->customer_email}}
                                        </div>  
                                    </li>

                                    {{-- cellulare --}}
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-phone-alt"></i>
                                            <span>Num-Telefono: </span>
                                        </div>

                                        <div class="mx-2 align-self-center infoData">
                                            {{$order->customer_phone}}
                                        </div>  
                                    </li>


                                </ul>
                            </div>
                       </li>

                    @empty
                           <h5 class="p-3 my-3">Non ci sono ordini   <i class="fas fa-utensils"></i></h5>
                    @endforelse
                    
                </ul>
            </div>

        </div>
    </section>
@endsection


{{-- ($dishes->isEmpty() --}}
{{--         @foreach ($order->dishes as $dish)
        @endforeach --}}