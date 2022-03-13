@extends('layouts.app')

@section('content')
<section>
    <div class="container pt-100 "  >
        <img class="img-des" src="{{ asset('img/1.png') }}" alt="">
        <div class="row justify-content-center">
             <div class="col-md-8" >
                 <div class="card">
                     <div class="card-header ">
                             <h4 class="text-center dash-welcome">
                             {{ Auth::user()->restaurant_name }}
                            </h4>
                             {{-- <i class="fa-solid fa-user-check icon-user"></i> --}}
                            <h4 class="text-center dash-title">Welcome {{ Auth::user()->name }}!</h4>
                        </div>
                        <div class="card-body">
                             {{-- <img class="img-dess" src="{{ asset('img/2.png') }}" alt=""> --}}
                        <p>
                            <button class="btn btn-dashboard w-100" type="button" data-bs-toggle="collapse"
                                data-bs-target="#cooking" aria-expanded="false" aria-controls="cooking">
                                Cosa cucini di buono oggi?
                                <i class="fa-solid fa-utensils"></i>
                            </button>
                        </p>
                        <div class="collapse" id="cooking">
                            <div class="card card-body">
                                Da qui puoi andare <a href="{{route('admin.dishes.index')}}" class="link-dashboard"> al tuo
                                    menu </a> o <a href="{{route('admin.dishes.create')}}" class="link-dashboard">aggiungere
                                    un nuovo piatto </a>.
                            </div>
                        </div>
                        <p>
                            <button class="btn btn-dashboard w-100" type="button" data-bs-toggle="collapse"
                                data-bs-target="#orders" aria-expanded="false" aria-controls="orders">
                                Come vanno gli affari? <i class="fa-solid fa-chart-line"></i>
                            </button>
                        </p>
                        <div class="collapse" id="orders">
                            <div class="card card-body">
                                Qui puoi vedere le <a href="{{route('admin.statistics')}}" class="link-dashboard">statistiche</a> relative ai
                                tuoi <a href="{{ route('admin.orders') }}" class="link-dashboard"> ordini</a>!
                            </div>
                        </div>
    
                        <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
    
                        {{ __('You are logged in!') }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection