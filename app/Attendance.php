<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public static function getRate($collection) {

        $attendances = $collection->map(function($e) { return $e->attendance; });
        $total_attendances = $attendances->count();
        $codes = $attendances->groupBy('attendance_code_id');
        $aggregation = [];

        dd($attendances);

        foreach($codes as $code => $attendance_per_code) {
            $aggregation[$code] = count($attendance_per_code) / $total_attendances;
        }

        return $aggregation;
    }
}
