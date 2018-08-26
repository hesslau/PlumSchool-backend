<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceCode;
use App\Course;
use App\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $students = Student::all();
        return view('home', compact('students','courses'));
    }

    public function courseAttendance($id) {
        $course = Course::find($id);
        $attendances = $course->attendances;
        $attendancesPerDay = $attendances->groupBy('attendance_date');
        $attendanceRatesPerDay = $attendancesPerDay->map(function($e) { return Attendance::calculateRates($e); });

        $missing = ($attendanceRatesPerDay->map(function($day) {
            if(key_exists(3,$day)) return $day[3];
            else return 0;
        }))->all();

        $late = ($attendanceRatesPerDay->map(function($day) {
            if(key_exists(2,$day)) return $day[2];
            else return 0;
        }))->all();

        $attended = ($attendanceRatesPerDay->map(function($day) {
            try {
                return ($day[1]+$day[2])*100;
            } catch (\Exception $exception) {
                return 0;
            }
        }))->all();

        //dd($attended,$late,$missing);

        $chartjs = app()->chartjs
            ->name('Attendance')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($attendanceRatesPerDay->keys()->all())
            ->datasets([
                [
                    "label" => "Attendance in %",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => array_values($attended),
                ]/*,
                /*[
                    "label" => "Late Students",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => array_values($late),
                ],
                [
                    "label" => "Missing",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => array_values($late),
                ]*/
            ])
            ->options([]);

        return view('course_attendance', compact('course', 'chartjs'));

    }

    public function studentsAttendance($id) {
        $student = Student::find($id);

        $attendanceRate = $student->attendanceRate();
        $chartjs = app()->chartjs
            ->name('Attendance')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Attendend', 'Late','Missing'])
            ->datasets([
                [
                    'backgroundColor' =>  ['rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 99, 132, 0.2)'],
                    'data' => array_values($attendanceRate),
                ]
            ])
            ->options([]);

        return view('students_attendance', compact('student', 'chartjs'));
    }


}
