@extends('/includes/template')


@section('content')

    <h1>Logboek rapportage</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Table with users --}}
            <div class="col-md-12">

                <table class="table table-striped table-hover">
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


            </div>
        </div>
    </div>


@endsection