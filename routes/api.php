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

Route::get('schools', function() {
    return response()->json(\App\School::all());
});

Route::get('caregiver_relationships', function() {
    return response()->json(\App\CaregiverRelationship::all());
});

Route::get('school/{id}/students', function($id) {
    return response()->json(\App\School::find($id)->students);
});

Route::get('school/{id}/courses', function($id) {
    return response()->json(\App\School::find($id)->courses);
});

Route::get('student/{id}/attendances', function($id) {
    return response()->json(\App\Student::find($id)->attendances);
});

Route::get('student/{id}/attendance_rate', function($id) {
    return response()->json(\App\Student::find($id)->attendanceRate());
});

// GET LABELS FOR IDS
Route::get('attendance_codes', function() {
    return response()->json(\App\AttendanceCode::all());
});

Route::get('enrollment_reasons', function() {
    return response()->json(\App\EnrollmentReason::all());
});

Route::get('course/{id}/attendance_rate', function($id) {
    return response()->json(\App\Course::find($id)->attendanceRate());
});

Route::get('course/{id}/attendances', function($id) {
    return response()->json(\App\Course::find($id)->attendances);
});

Route::post('students', function(Request $filters) {
    return response()->json(\App\StudentSearch::apply($filters));
});

Route::post('students/attendance_rate', function(Request $filters) {
    return response()->json(\App\Attendance::getRate(\App\StudentSearch::apply($filters)));
});

Route::post('courses', function(Request $filters) {
    return response()->json(\App\CourseSearch::apply($filters));
});

Route::post('courses/attendance_rate', function(Request $filters) {
    return response()->json(\App\Attendance::getRate(\App\CourseSearch::apply($filters)));
});

// DATA ENTRIES
Route::post('user', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    $data['role_id'] = Role::where('name', $data['role_name'])->first()->id;
    \App\User::create($data);
});

Route::post('role', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    Role::create($data);
});

Route::post('course', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    \App\Course::create($data);
});

Route::post('caregiver_relationship', function(Request $request) {
    $data = json_decode($request->getContent(), true);
   \App\CaregiverRelationship::create($data);
});

Route::post('course_name', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    \App\CourseName::create($data);
});

Route::post('course_schedule', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    \App\CourseSchedule::create($data);
});

Route::post('enrollment_reason', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    \App\EnrollmentReason::create($data);
});

Route::post('enrollment_status', function(Request $request) {
    $data = json_decode($request->getContent(), true);
    \App\EnrollmentStatus::create($data);
});

Route::post('enrollment', function(Request $request){
    $data = json_decode($request->getContent(), true);
    \App\Enrollment::create($data);
});

Route::post('attendance_code', function(Request $request){
    $data = json_decode($request->getContent(), true);
    \App\AttendanceCode::create($data);
});

Route::post('attendance', function(Request $request){
    $data = json_decode($request->getContent(), true);
    \App\Attendance::create($data);
});

Route::post('student', function(Request $request){
    $data = json_decode($request->getContent(), true);
    Student::create($data);
});

Route::post('school', function(Request $request){
    $data = json_decode($request->getContent(), true);
    \App\School::create($data);
});