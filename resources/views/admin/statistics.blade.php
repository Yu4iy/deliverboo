@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="title-chart">Ecco le tue statistiche:</h2>
        <div class="row">
            <div class="col">
                <button type="button" class="year btn btn-dark">Anno</button>
                <button type="button" class="month btn btn-dark">Mese</button>
                <button type="button" class="day btn btn-dark">Giorno</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection