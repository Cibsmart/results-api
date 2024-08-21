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

Route::get('course-registrations/', [CourseRegistrationController::class, 'index']);
Route::get('course-registrations/registration-number/{registrationNumber}',
    [CourseRegistrationController::class, 'courseRegistrationsByRegistrationNumber']);
Route::get('course-registrations/department/{department}/session/{session}/semester/{semester}',
    [CourseRegistrationController::class, 'courseRegistrationsByDepartmentSessionAndSemester']);
Route::get('course-registrations/department/{department}/session/{session}/level/{level}',
    [CourseRegistrationController::class, 'courseRegistrationsByDepartmentSessionAndLevel']);
Route::get('course-registrations/session/{session}/course/{course}',
    [CourseRegistrationController::class, 'courseRegistrationBySessionAndCourse']);
Route::get('course-registrations/session/{session}/semester/{semester}',
    [CourseRegistrationController::class, 'courseRegistrationBySessionAndSemester']);


Route::get('results/', [ResultController::class, 'index']);
Route::get('results/course-registration/{courseRegistrationId}',
    [ResultController::class, 'resultByCourseRegistrationId']);
Route::get('results/registration-number/{registrationNumber}',
    [ResultController::class, 'resultsByRegistrationNumber']);
Route::get('results/department/{department}/session/{session}/semester/{semester}',
    [ResultController::class, 'resultsByDepartmentSessionAndSemester']);
Route::get('results/department/{department}/session/{session}/level/{level}',
    [ResultController::class, 'resultsByDepartmentSessionAndLevel']);
Route::get('results/session/{session}/course/{course}',
    [ResultController::class, 'resultsBySessionAndCourse']);
Route::get('results/session/{session}/semester/{semester}',
    [ResultController::class, 'resultsBySessionAndSemester']);