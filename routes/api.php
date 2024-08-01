<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('departments', [DepartmentController::class, 'index']);

Route::get('students/', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'studentById']);
Route::get('students/registration-number/{registrationNumber}',
    [StudentController::class, 'studentByRegistrationNumber']);
Route::get('students/department/{department}/admission-year/{admissionYear}',
    [StudentController::class, 'studentsByDepartmentAndAdmissionYear']);
Route::get('students/admission-year/{admissionYear}',
    [StudentController::class, 'studentsByAdmissionYear']);

Route::get('passport/{id}', [StudentController::class, 'passportWithId']);
Route::get('passport/registration-number/{registrationNumber}',
    [StudentController::class, 'passportWithRegistrationNumber']);
