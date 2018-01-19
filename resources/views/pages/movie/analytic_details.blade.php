@extends('/includes/template')


@section('content')

    <h1>Movie analyse</h1>

    <div class="container-fluid">
        {{-- First row of both the top days watched and devices --}}
        <div class="row">

            {{-- Dagen met de meeste kijkers --}}
            <div class="col-md-6">
                <h3>Movies</h3>


                <table class="table table-striped table-hover">

                    <tr>
                        <th>Movie name</th>
                        <td>{{ $movie->movie_title }}</td>
                    </tr>

                    <tr>
                        <th>IMDb rating</th>
                        <td>{{ $movie->imdb_score }}</td>
                    </tr>

                    <tr>
                        <th>Facebook likes</th>
                        <td>{{ $movie->movie_facebook_likes }}</td>
                    </tr>

                    <tr>
                        <th>Director</th>
                        <td>{{ $movie->director_name }}</td>
                    </tr>

                    <tr>
                        <th>Director facebook likes</th>
                        <td>{{ $movie->director_facebook_likes }}</td>
                    </tr>

                    <tr>
                        <th>Number of critics</th>
                        <td>{{ $movie->num_critic_for_reviews }}</td>
                    </tr>

                    <tr>
                        <th>Gross revenue</th>
                        <td>{{ number_format($movie->gross, 2, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th>Budget</th>
                        <td>{{ number_format($movie->budget, 2, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th>Margin of profit</th>
                        <td>{{ number_format($movie->profit, 2, ',', '.') }}%</td>
                    </tr>

                    <tr>
                        <th>Truth percentage</th>
                        <td>{{ !is_null($movie->getTruthPercentage()) ? $movie->getTruthPercentage() . '%' : 'Unknown' }}</td>
                    </tr>

                    <tr>
                        <th>Categories</th>
                        <td>{!! implode(', ', array_map(function($v) {
                            return '<a href="/movies/genre/'.urlencode($v['genre']).'">' . $v['genre'] . '</a>'; },
                            $movie->getCategories()))
                        !!}</td>
                    </tr>

                    <tr>
                        <th>Keywords</th>
                        <td>{!! implode(', ', array_map(function($v) {
                            return '<a href="/movies/keyword/'.urlencode($v['keyword']).'">' . $v['keyword'] . '</a>';
                            }, $movie->getKeywords()))
                        !!}</td>
                    </tr>

                </table>

            </div>

            {{-- Aantal devices --}}
            <div class="col-md-6">
                <h3>Actors</h3>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>#</th>
                        <th>Actor</th>
                        <th>Facebook likes</th>
                    </tr>

                    <tr>
                        <th>1</th>
                        <td>{{ $movie->actor_1_name }}</td>
                        <td>{{ $movie->actor_1_facebook_likes }}</td>
                    </tr>

                    <tr>
                        <th>2</th>
                        <td>{{ $movie->actor_2_name }}</td>
                        <td>{{ $movie->actor_2_facebook_likes }}</td>
                    </tr>

                    <tr>
                        <th>3</th>
                        <td>{{ $movie->actor_3_name }}</td>
                        <td>{{ $movie->actor_3_facebook_likes }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection