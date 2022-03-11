@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="title-chart">Ecco le tue statistiche:</h2>
        <div class="row">
            <div class="col">
                <button type="button" class="year btn btn-dark">Anno</button>
                <button type="button" class="month btn btn-dark">Mese</button>

                <select name="year" id="month-select">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
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