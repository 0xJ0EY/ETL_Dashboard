<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogboekController extends Controller implements IDar
{

    public function data() {
        $topWatched     = \App\Log::getTopWatchedGChart(5);
        $devices        = \App\Log::getDevicesGChart();
        $kpiRating      = \App\Log::getKpiRating();

        return view('pages.logboek.data', [
            'topWatched' => $topWatched,
            'kpiRating' => $kpiRating,
            'devices'   => $devices
        ]);
    }

    public function dataDetails($id) {

    }

    public function analytic() {
        $students       = \App\Log::getAllDistinctStudents()->paginate(15);
        $scatter        = \App\Log::getAllDistinctStudentsGChart();

        return view('pages.logboek.analytic', [
            'students'  => $students,
            'scatter'   => $scatter
        ]);
    }

    public function analyticDetails($id) {
        $logs       = \App\Log::select()->where('student_number', '=', $id);
        if (!$logs->count()) return redirect('logboek/analytic/');

        $student    = \App\Log::selectRaw("
                DISTINCT(student_number) student_number,
                SEC_TO_TIME(AVG(TIME_TO_SEC(time_watched))) avg_time_watched,
                AVG(rating) avg_rating")
            ->groupBy('student_number')
            ->where('student_number', '=', $id)->first()
        ;

        return view('pages.logboek.analytic_details', [
            'logs'      => $logs->paginate(15),
            'student'   => $student
        ]);

    }

    public function report() {
        $logs           = \App\Log::paginate(30);

        return view('pages.logboek.report', [
            'logs' => $logs
        ]);
    }

    public function reportDetails($id) {

    }

}

