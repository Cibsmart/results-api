<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('departments', [DepartmentController::class, 'index']);

Route::get('students/', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'studentById']);
Route::get('students/registration-number/{registrationNumber}',
    [StudentController::class, 'studentByRegistrationNumber']);
Route::get('students/department/{department}/session/{session}',
    [StudentController::class, 'studentsByDepartmentAndSession']);
Route::get('students/session/{session}',
    [StudentController::class, 'studentsBySession']);

Route::get('passport/{id}', [StudentController::class, 'passportWithId']);
Route::get('passport/registration-number/{registrationNumber}',
    [StudentController::class, 'passportWithRegistrationNumber']);


Route::get('results/', [ResultController::class, 'index']);
Route::get('results/{id}', [ResultController::class, 'resultById']);
Route::get('results/registration-number/{registrationNumber}',
    [ResultController::class, 'resultsByRegistrationNumber']);
Route::get('results/department/{department}/session/{session}/semester/{semester}',
    [ResultController::class, 'resultsByDepartmentSessionAndSemester']);
Route::get('results/department/{department}/session/{session}/level/{level}',
    [ResultController::class, 'resultsByDepartmentSessionAndLevel']);
Route::get('results/session/{session}/course/{course}',
    [ResultController::class, 'resultsBySessionAndCourse']);