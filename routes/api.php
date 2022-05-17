<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/User',\App\Http\Controllers\StudentController::class);
Route::resource('/Instructor',\App\Http\Controllers\InstructorController::class);
Route::resource('/Category',\App\Http\Controllers\CategoryController::class);
Route::resource('/Course',\App\Http\Controllers\CourseController::class);
Route::resource('/StudentCourse',\App\Http\Controllers\StudentCourseController::class);
Route::resource('/Attendance',\App\Http\Controllers\StudentAttendanceController::class);
Route::post('/importCsv',[\App\Http\Controllers\CSVFileController::class,"importCsv"]);
Route::post('/TimeSheet',[\App\Http\Controllers\StudentAttendanceController::class,"StudentTimeSheet"]);


