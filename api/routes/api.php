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


Route::group(['middleware'=>'jwt.auth'],function(){});


//Route::post('/stude', [App\Http\Controllers\Student\RegisterController::class, 'store']);
Route::apiResource('student','App\Http\Controllers\Student\RegisterController');
Route::apiResource('course','App\Http\Controllers\Student\CourseController');
Route::apiResource('student_course','App\Http\Controllers\Student\StudentCourseController');