@extends('/includes/template')


@section('content')

    <h1>Logboek data</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Dagen met de meeste kijkers --}}
            <div class="col-md-6">
                <h3>Dagen met de meeste kijkers</h3>
                <div class="google-table" id="top-watched"></div>
            </div>

            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Aantal devices</h3>
                <div class="google-table" id="device"></div>
            </div>
        </div>
    </div>


    <script>

        google.charts.load('current', {'packages':['corechart', 'gauge', 'treemap']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            {{--var kpiRatingsData = google.visualization.arrayToDataTable([--}}
                {{--['Label', 'Value'],--}}
                {{--['Avarage rating', {!! $kpiRating->avg_rating !!}]--}}
            {{--]);--}}

            {{--var kpiRatingsOptions = {--}}
                {{--width: 400, height: 200,--}}
                {{--redFrom: 0, redTo: 1,--}}
                {{--yellowFrom:1, yellowTo: 3,--}}
                {{--greenFrom: 9, greenTo: 10,--}}
                {{--minorTicks: 5,--}}
                {{--max: 10--}}
            {{--};--}}

//            var kpiRatingsChart = new google.visualization.Gauge(document.getElementById('kpiRating'));
//
//            kpiRatingsChart.draw(kpiRatingsData, kpiRatingsOptions);

            var topWatchedData = google.visualization.arrayToDataTable({!! json_encode($topWatched) !!});
            var topWatchedChart = new google.visualization.ColumnChart(document.getElementById('top-watched'));

            topWatchedChart.draw(topWatchedData, {
                width: 600,
                height: 400,
                chartArea: {'width': '100%', 'height': '80%'},
                legend: {'position': 'bottom'}
            });

            var deviceData = google.visualization.arrayToDataTable({!! json_encode($devices) !!});
            var deviceChart = new google.visualization.TreeMap(document.getElementById('device'));

            deviceChart.draw(deviceData, {
                width: 650,
                height: 400,
                minColor: '#f00',
                midColor: '#ddd',
                maxColor: '#0d0',
                headerHeight: 15,
                fontColor: 'black',
                showScale: true
            });
        }

    </script>
@endsection