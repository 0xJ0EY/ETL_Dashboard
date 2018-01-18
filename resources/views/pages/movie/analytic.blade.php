@extends('/includes/template')


@section('content')

    <h1>Movie analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Dagen met de meeste kijkers --}}
            <div class="col-md-6">
                <h3>Movies</h3>


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
                        <th>Title</th>
                        <th>Fb likes</th>
                        <th>IMDb score</th>
                        <th>Margin of profit</th>
                    </tr>

                    @foreach ($movies as $movie)
                        <tr>
                            <td><a href="/movies/analytic/{!! urlencode($movie->movie_title) !!}/">{{ $movie->movie_title }}</a></td>
                            <td>{{ $movie->movie_facebook_likes }}</td>
                            <td>{{ number_format($movie->imdb_score, 2, ',', '.') }}</td>
                            <td>{{ number_format($movie->getProfitPercentage(), 2, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </table>

                {{ $movies->render() }}
            </div>
        </div>
    </div>
@endsection