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
    
    Route::controller(AssignmentController::class)->group(function (){
        Route::put('assignment/teacher/{teacher_id}/course/{course_id}', 'assignment');
        Route::delete('assignment/{id}', 'destroy');
    });
    Route::post('logout', [UserController::class, 'logout']);
});

Route::controller(UserController::class)->group(function() {
    Route::post('login', 'login');
    Route::get('checkAuth', 'checkAuth')->name('loginToContinue');
});
