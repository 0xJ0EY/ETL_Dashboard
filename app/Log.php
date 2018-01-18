<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logboek';

    public static function getKpiRating() {
        return self::selectRaw('AVG(rating) AS avg_rating, MAX(rating) AS max_rating')->get()[0];
    }


    /* Should've use a factory for this shit */
    public static function getDevices() {
        return self::selectRaw('device, count(*) AS count')
            ->groupBy('device')
            ->orderBy('count', 'DESC')->get()
        ;
    }

    public static function getDevicesGChart() {
        $devices = self::getDevices();
        $response = [];
        $response[] = ['Apparaat', 'parent', 'value'];
        $response[] = ['Apparaten', null, 0];

        foreach ($devices as $device) {
            $response[] = [
                $device->device,
                'Apparaten',
                $device->count
            ];
        }

        return $response;
    }

    public static function getTopWatched($top) {
        return self::selectRaw('COUNT(*) AS count, DATE(date_watched) AS date_watched')
            ->groupBy('date_watched')
            ->orderBy('count', 'DESC')
            ->limit($top)
        ;
    }

    public static function getTopWatchedGChart($top) {
        $days = self::getTopWatched($top)->get();
        $response = [];
        $response[] = ['Datum', 'Kijkers'];

        foreach ($days as $day) {
            $response[] = [
                $day->date_watched,
                $day->count
            ];
        }

        return $response;
    }

    public static function getAllDistinctStudents() {
        return self::selectRaw("
                DISTINCT(student_number) student_number,
                SEC_TO_TIME(AVG(TIME_TO_SEC(time_watched))) avg_time_watched,
                AVG(rating) avg_rating")
            ->groupBy('student_number')
            ->orderBy('student_number')
        ;
    }

    public static function getAllDistinctStudentsGChart() {
        $students = self::getAllDistinctStudents()->get();

        $response = [];
        $response[] = ['Tijd gekeken', 'Beoordeling'];

        foreach ($students as $student) {
            $avgTimeWatched = $student->avg_time_watched;
            list($hours, $minutes, $seconds) = explode(':', $avgTimeWatched);

            $seconds += $minutes * 60;
            $seconds += $hours * 60 * 60;

            $response[] = [
                (int)floor($seconds / 60),
                (float)$student->avg_rating
            ];
        }

        return $response;
    }


    public function isComplete() {
        $completed = true;
        $values = $this->toArray();

        foreach ($values as $value) {
            if (empty($values)) $completed = false;
        }

        return $completed;

    }

}
