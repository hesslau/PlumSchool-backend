<?php

use Illuminate\Http\Request;
use App\Student;

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
