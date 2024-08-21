<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('departments', DepartmentController::class);

Route::get('courses', CourseController::class);

Route::get('students', StudentController::class);

Route::get('students/passport', PassportController::class);

Route::get('course-registrations', CourseRegistrationController::class);

Route::get('results', ResultController::class);
