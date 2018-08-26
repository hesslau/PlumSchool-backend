<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [
        'id '
    ];


    public function courses() {
        return $this->belongsToMany('App\Course','enrollments');
    }

    public function attendances() {
        return $this->hasMany('App\Attendance');
    }

    public function attendanceRate() {
        $attendances = $this->attendances()->get();
        $total_attendances = $attendances->count();
        $codes = $this->attendances()->get()->groupBy('attendance_code_id');
        $aggregation = [];

        foreach($codes as $code => $attendance_per_code) {
            $aggregation[$code] = count($attendance_per_code) / $total_attendances;
        }

        return $aggregation;
    }
}
