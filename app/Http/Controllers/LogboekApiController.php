<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogboekApiController extends Controller
{
    public function getAll() {
        return \App\Log::all();
    }

    public function getTopDevices() {
        return \App\Log::selectRaw('device, count(*) AS count')
            ->groupBy('device')
            ->orderBy('count', 'DESC')->get()
        ;
    }
}
