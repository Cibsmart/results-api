<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseRegistrationResource;
use App\Models\Department;
use App\Models\Result;
use Illuminate\Support\Str;

class CourseRegistrationController extends Controller
{
    public function index()
    {
        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection(Result::query()->limit(100)->get()),
            message: 'success',
        );
    }

    public function courseRegistrationsByRegistrationNumber(string $registrationNumber)
    {
        $registrationNumber = Str::replace('-', '/', $registrationNumber);

        $results = Result::query()
            ->where('registration_number', $registrationNumber)
            ->get();

        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection($results),
            message: $results->count(),
        );
    }

    public function courseRegistrationsByDepartmentSessionAndSemester(
        Department $department,
        string $session,
        string $semester
    ) {

        $session = Str::replace('-', '/', $session);

        $results = $department->results()
            ->where('session', $session)
            ->where('semester', $semester)
            ->get();

        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection($results),
            message: $results->count()
        );

    }

    public function courseRegistrationsByDepartmentSessionAndLevel(
        Department $department,
        string $session,
        string $level
    ) {

        $session = Str::replace('-', '/', $session);

        $results = $department->results()
            ->where('session', $session)
            ->where('level', $level)
            ->get();

        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection($results),
            message: $results->count()
        );
    }

    public function courseRegistrationBySessionAndCourse(
        string $session,
        string $course
    ) {

        $session = Str::replace('-', '/', $session);
        $course = Str::replace('-', ' ', $course);

        $results = Result::query()
            ->where('session', $session)
            ->where('course_code', $course)
            ->get();

        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection($results),
            message: $results->count()
        );
    }

    public function courseRegistrationBySessionAndSemester(
        string $session,
        string $semester
    ) {

        $session = Str::replace('-', '/', $session);

        $results = Result::query()
            ->where('session', $session)
            ->where('semester', $semester)
            ->get();

        return $this->respondWithSuccess(
            data: CourseRegistrationResource::collection($results),
            message: $results->count()
        );
    }
}
