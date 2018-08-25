<?php

use Illuminate\Http\Request;
use App\Student;
use App\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', function() {
    return response()->json(Student::all());
});

Route::get('student/{id}/courses', function($id) {
    return response()->json(Student::find($id)->courses);
});

Route::post('user', function(Request $request) {
    $post = $request->all();
    $post['role'] = Role::where('role_name', $request->all()['role_name'])->first()->id;
    \App\User::create($post);
});

Route::post('role', function(Request $request) {
    Role::create($request->all());
});

Route::post('course', function(Request $request) {
    \App\Course::create($request->all());
});

Route::post('caregiver_relationship', function(Request $request) {
   \App\CaregiverRelationship::create($request->all());
});

Route::post('course_name', function(Request $request) {
    \App\CourseName::create($request->all());
});

Route::post('course_schedule', function(Request $request) {
    \App\CourseSchedule::create($request->all());
});

Route::post('enrollment_reason', function(Request $request) {
    \App\EnrollmentReason::create($request->all());
});

Route::post('enrollment_status', function(Request $request) {
    \App\EnrollmentStatus::create($request->all());
});

Route::post('enrollment', function(Request $request){
    \App\Enrollment::create($request->all());
});

Route::post('attendance_code', function(Request $request){
    \App\AttendanceCode::create($request->all());
});

Route::post('attendance', function(Request $request){
    \App\Attendance::create($request->all());
});

Route::post('student', function(Request $request){
    Student::create($request->all());
});

Route::post('school', function(Request $request){
    \App\School::create($request->all());
});