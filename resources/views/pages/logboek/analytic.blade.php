@extends('/includes/template')

@section('content')
    <h1>Logboek analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Table with users --}}
            <div class="col-md-6">

                <h3>Studenten</h3>

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Student nummer</th>
                        <th>Gemiddelde gekeken tijd</th>
                        <th>Gemiddelde beoordeling</th>
                    </tr>

                    @foreach ($students as $student)
                        <tr>
                            <td><a href="/logboek/analytic/{{ $student->student_number }}">{{ $student->student_number }}</a></td>
                            <td>{{ $student->avg_time_watched }}</td>
                            <td>{{ number_format($student->avg_rating, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach

                </table>

                {{ $students->render() }}
            </div>

            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Aantal devices</h3>

                <div id="scatter"></div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable({!! json_encode($scatter) !!});

            var options = {
                vAxis: {title: 'Gemiddeld cijfer'},
                hAxis: {title: 'Minuten gekeken'},
                legend: 'none'
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('scatter'));

            chart.draw(data, options);
        }
    </script>
@endsection