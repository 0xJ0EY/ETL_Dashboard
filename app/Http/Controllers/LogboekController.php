<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogboekController extends Controller implements IDar
{
    public function analytic() {
        if ($query = \Input::get('query')) {
            $cols = array_keys(\App\Log::first()->toArray());
            $cols = implode(', ', $cols);

            $students = \App\Log::getAllDistinctStudents()
                ->whereRaw("LOWER(CONCAT_WS('|', {$cols})) LIKE ?", ['%'.$query.'%'])
                ->orderBy('student_number', 'ASC')
                ->paginate(15);

            $students->appends(\Input::except('page'));

        } else {
            $students = \App\Log::getAllDistinctStudents()->paginate(15);
        }

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
                SEC_TO_TIME(SUM(TIME_TO_SEC(time_watched))) total_time_watched,
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

        if ($query = \Input::get('query')) {
            $cols = array_keys(\App\Log::first()->toArray());
            $cols = implode(', ', $cols);

            $logs = \App\Log::select('*')
                ->whereRaw("LOWER(CONCAT_WS('|', {$cols})) LIKE ?", ['%'.$query.'%'])
                ->paginate(30);

            $logs->appends(\Input::except('page'));

        } else {
            $logs = \App\Log::paginate(30);
        }

        return view('pages.logboek.report', [
            'logs' => $logs
        ]);
    }
}

