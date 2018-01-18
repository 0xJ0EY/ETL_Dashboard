@extends('/includes/template')

@section('content')
    <h1>Logboek analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">
            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Logs</h3>



                <table class="table">

                    <tr>
                        <th>#</th>
                        <th>Student nummer</th>
                        <th>Apparaat</th>
                        <th>Kanaal</th>
                        <th>Video</th>
                        <th>Tijd gekeken</th>
                        <th>Beoordeling</th>
                    </tr>

                    @foreach ($logs as $log)
                        <tr class="{{ $log->isComplete() ? "complete" : "danger"}}">
                            <td>{{ $log->id }}</td>
                            <td><a href="/logboek/analytic/{{ $log->student_number }}">{{ $log->student_number }}</a></td>
                            <td>{{ $log->device }}</td>
                            <td>{{ $log->channel }}</td>
                            <td>{{ $log->video }}</td>
                            <td>{{ $log->time_watched }}</td>
                            <td>{{ $log->rating }}</td>
                        </tr>
                    @endforeach
                </table>

                {{ $logs->render() }}


                <div id="scatter"></div>
            </div>

            {{-- Table with users --}}
            <div class="col-md-6">
                <h3>Student</h3>

                <table class="table">
                    <tr>
                        <th>Student nummer</th>
                        <td>{{ $student->student_number }}</td>
                    </tr>

                    <tr>
                        <th>Gemiddelde gekeken tijd</th>
                        <td>{{ $student->avg_time_watched }}</td>
                    </tr>

                    <tr>
                        <th>Gemiddelde beoordeling</th>
                        <td>{{ $student->avg_rating }}</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
@endsection