<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public static function getRate($collection) {

        $attendances = $collection->flatMap(function($e) { return $e->attendances; });
        $total_attendances = $attendances->count();
        $codes = $attendances->groupBy('attendance_code_id');
        $aggregation = [];

        //dd($attendances);

        foreach($codes as $code => $attendance_per_code) {
            $aggregation[$code] = count($attendance_per_code) / $total_attendances;
        }

        return $aggregation;
    }


    public static function calculateRates($listOfAttendances) {
        $total_attendances = $listOfAttendances->count();
        $codes = $listOfAttendances->groupBy('attendance_code_id');
        $aggregation = [];

        //dd($attendances);

        foreach($codes as $code => $attendance_per_code) {
            $aggregation[$code] = count($attendance_per_code) / $total_attendances;
        }

        return $aggregation;
    }
}
