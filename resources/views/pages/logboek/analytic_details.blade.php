@extends('/includes/template')

@section('content')
    <h1>Logs analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">
            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Logs</h3>

                <table class="table table-striped table-hover">

                    <tr>
                        <th>#</th>
                        <th>Student number</th>
                        <th>Device</th>
                        <th>Channel</th>
                        <th>Video</th>
                        <th>Time watched</th>
                        <th>Rating</th>
                    </tr>

                    @foreach ($logs as $log)
                        <tr class="{{ $log->isComplete() ? "complete" : "danger"}}">
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->student_number }}</td>
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

                <table class="table table-striped table-hover">
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