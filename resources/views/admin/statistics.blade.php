@extends('layouts.app')

@section('content')
    <div class="container padding-grafico">
        <h2 class="title-chart">Ecco le tue statistiche divise per mesi:</h2>
        {{-- <div class="row">
            <div class="col">
                <div>
                    <canvas id="myChart1"></canvas>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div> --}}

        <Statistics
            :labels="{{ json_encode($day_labels) }}"
            :datas="{{ json_encode($day_data) }}"
        />

    </div>
@endsection

{{-- @section('scripts')
    <script src="{{ asset('js/chart.js') }}" defer></script>
@endsection --}}