@extends('layouts.app')

@section('content')
<div class="container pt-100">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5" >
            <div class="card">
                <div class="card-header">
                    <h1>Ciao
                        {{ Auth::user()->name }}!
                        <i class="fa-solid fa-user-check icon-user"></i>
                    </h1>
                </div>
                <div class="card-body">
                    <p>
                        <button class="btn btn-dashboard" type="button" data-bs-toggle="collapse"
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
                        <button class="btn btn-dashboard" type="button" data-bs-toggle="collapse"
                            data-bs-target="#orders" aria-expanded="false" aria-controls="orders">
                            Come vanno gli affari? <i class="fa-solid fa-chart-line"></i>
                        </button>
                    </p>
                    <div class="collapse" id="orders">
                        <div class="card card-body">
                            <a href="#" class="link-dashboard">Cliccando qui</a> puoi vedere le statistiche relative ai
                            tuoi ordini!
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
@endsection