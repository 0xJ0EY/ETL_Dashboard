@extends('/includes/template')


@section('content')

    <h1>Logs report</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Table with users --}}
            <div class="col-md-12">

                <h3>Logs data</h3>

                <form class="form-horizontal search-container">
                    <div class="right search col-sm-4">
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