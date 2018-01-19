@extends('/includes/template')

@section('content')
    <h1>Logs analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Table with users --}}
            <div class="col-md-6">

                <h3>Students</h3>

                <form class="form-horizontal search-container">
                    <div class="search col-sm-8">
                        <div class="input-group">
                            <input name="query" type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Search</button>
                           </span>
                        </div>
                    </div>
                </form>


                <table class="table table-striped table-hover">
                    <tr>
                        <th>Student number</th>
                        <th>Total time watched</th>
                        <th>Avg time watched</th>
                        <th>Avg rating</th>
                    </tr>

                    @foreach ($students as $student)
                        <tr>
                            <td><a href="/logboek/analytic/{{ $student->student_number }}">{{ $student->student_number }}</a></td>
                            <td>{{ $student->total_time_watched }}</td>
                            <td>{{ $student->avg_time_watched }}</td>
                            <td>{{ number_format($student->avg_rating, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach

                </table>

                {{ $students->render() }}
            </div>

            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Avg rating / Minutes watched</h3>

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