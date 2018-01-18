<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie_data';


    public function getCategories() {
        $data = \DB::table('movie_genres')
            ->select('genre')
            ->where('movie_id', '=', $this->id)
            ->get();
        ;

        return collect($data)->map(function($x){ return (array) $x; })->toArray();
    }

    public function getKeywords() {
        $data = \DB::table('movie_keywords')
            ->select('keyword')
            ->where('movie_id', '=', $this->id)
            ->get();
        ;

        return collect($data)->map(function($x){ return (array) $x; })->toArray();
    }

    public function getTruthPercentage() {
        $data = \DB::table('movie_truth')
            ->selectRaw('SUM(truth) AS truth, COUNT(*) AS total')
            ->where('movie_id', '=', $this->id)
            ->first();
        ;

        if (!$data->truth || !$data->total) return null;
        return $data->total / $data->truth;
    }

    public function getProfitPercentage() {
        return $this->profit;
    }
}
