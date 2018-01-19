@extends('/includes/template')


@section('content')

    <h1>Movie report</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">
            <div class="col-md-12">

                <h3>Movie data : {{ $keyword }}</h3>

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Title</th>
                        <th>Fb likes</th>
                        <th>Year</th>
                        <th>IMDb score</th>
                        <th>Budget</th>
                        <th>Gross revenue</th>
                        <th>Margin of profit</th>
                        <th>Truth %</th>
                        <th>Categories</th>
                        <th>Keywords</th>
                    </tr>

                    @foreach ($movies as $movie)
                        <tr>
                            <td><a href="/movies/analytic/{!! urlencode($movie->movie_title) !!}/">{{ $movie->movie_title }}</a></td>
                            <td>{{ $movie->movie_facebook_likes }}</td>
                            <td>{{ $movie->title_year }}</td>
                            <td>{{ number_format($movie->imdb_score, 2, ',', '.') }}</td>
                            <td>{{ number_format($movie->budget, 2, ',', '.') }}</td>
                            <td>{{ number_format($movie->gross, 2, ',', '.') }}</td>
                            <td>{{ number_format($movie->getProfitPercentage(), 2, ',', '.') }}%</td>
                            <td>{{ !is_null($movie->getTruthPercentage()) ? $movie->getTruthPercentage() . '%' : 'Unknown' }}</td>
                            <td>{!! implode(', ', array_map(function($v) {
                                return '<a href="/movies/genre/'.urlencode($v['genre']).'">' . $v['genre'] . '</a>'; },
                                $movie->getCategories()))
                                !!}</td>
                            <td>{!! implode(', ', array_map(function($v) {
                                return '<a href="/movies/keyword/'.urlencode($v['keyword']).'">' . $v['keyword'] . '</a>';
                                }, $movie->getKeywords())) !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            {{ $movies->render() }}
        </div>
    </div>
@endsection