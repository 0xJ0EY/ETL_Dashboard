<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller implements IDar
{
    public function analytic() {

        if ($query = \Input::get('query')) {
            $cols = array_keys(\App\Movie::first()->toArray());
            $cols = implode(', ', $cols);

            $movies = \App\Movie::select('*')
                ->whereRaw("LOWER(CONCAT_WS('|', {$cols})) LIKE ?", ['%'.$query.'%'])
                ->orderBy('movie_title')
                ->paginate(15);

            $movies->appends(\Input::except('page'));

        } else {
            $movies = \App\Movie::orderBy('movie_title')->paginate(15);
        }

        return view('pages.movie.analytic', [
            'movies' => $movies
        ]);
    }

    public function analyticDetails($id) {
        $movieName = urldecode($id);
        $movie = \App\Movie::where('movie_title', '=', $movieName);

        if ($movie->count() == 0) return redirect('movies/analytic');

        return view('pages.movie.analytic_details', [
            'movie' => $movie->first()
        ]);
    }

    public function report() {
        if ($query = \Input::get('query')) {
            $cols = array_keys(\App\Movie::first()->toArray());
            $cols = implode(', ', $cols);

            $movies = \App\Movie::select('*')
                ->whereRaw("LOWER(CONCAT_WS('|', {$cols})) LIKE ?", ['%'.$query.'%'])
                ->orderBy('movie_title')
                ->paginate(15);

            $movies->appends(\Input::except('page'));

        } else {
            $movies = \App\Movie::orderBy('movie_title')->paginate(15);
        }

        return view('pages.movie.report', [
            'movies' => $movies
        ]);
    }

    public function genre($genre) {
        $genre = urldecode($genre);

        $movies = \App\Movie::whereIn('id', function($movies) use ($genre) {
            $movies
                ->select('movie_id')
                ->from('movie_genres')
                ->where('genre', '=', $genre);
        })->orderBy('movie_title');

        return view('pages.movie.genre', [
            'genre'     => ucfirst($genre),
            'movies'    => $movies->paginate(15)
        ]);
    }
}
