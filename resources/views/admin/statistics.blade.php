@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="title-chart">Scegli le tue statistiche:</h2>
        <h2 class="title-chart d-none">Ecco le tue statistiche:</h2>
        <div class="row">
            <div class="col">
                {{-- <button type="button" class="year btn btn-dark">Anno</button>
                <button type="button" class="month btn btn-dark">Mese</button>

                <button type="button" class="btn btn-dark prova">Prova</button> --}}

                <select class="d-none select-month" name="month" id="month-select">
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

                <select class="d-none select-year" name="year" id="year-select">
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                </select>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col">
                <div>
                    <canvas id="myChart1"></canvas>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div> --}}
        <div class="orderTitileContainer pt-5">
            <h1>Statistiche dell'ultimo mese</h1>
        </div>
        <Statistics class="pb-5 mt-4"
            :labels="{{ json_encode($day_labels) }}"
            :datas="{{ json_encode($total_sales_data) }}"
            :orders="{{ json_encode($total_orders_number) }}"
        />

    </div>
@endsection

{{-- @section('scripts')
    <script src="{{ asset('js/chart.js') }}" defer></script>
@endsection --}}