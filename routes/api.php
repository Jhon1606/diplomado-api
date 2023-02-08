<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;

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
Route::middleware('auth:sanctum')->group(function (){
    Route::resource('teachers', TeacherController::class);
    Route::resource('courses', CourseController::class);
    Route::put('assignment/teacher/{teacher_id}/course/{course_id}', [AssignmentController::class, 'assignment']);
    Route::post('logout',[UserController::class, 'logout']);
});


Route::post('login',[UserController::class, 'login']);