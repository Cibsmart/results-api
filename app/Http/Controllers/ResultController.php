<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResultResource;
use App\Models\Department;
use App\Models\Result;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::query()->limit(100)->get();
        return $this->respondWithSuccess(
            data: ResultResource::collection($results),
            message: $results->count(),
        );
    }

    public function resultByCourseRegistrationId(string $courseRegistrationId)
    {
        return $this->respondWithSuccess(
            data: new ResultResource(Result::query()
                ->where('id', $courseRegistrationId)
                ->firstOrFail()
            ),
            message: 'success',
        );
    }
//
    public function resultsByRegistrationNumber(string $registrationNumber)
    {
        $registrationNumber = Str::replace('-', '/', $registrationNumber);

        $results = Result::query()
            ->where('registration_number', $registrationNumber)
            ->get();

        return $this->respondWithSuccess(
            data: ResultResource::collection($results),
            message: $results->count(),
        );
    }

    public function resultsByDepartmentSessionAndSemester(
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
            data: ResultResource::collection($results),
            message: $results->count()
        );

    }

    public function resultsByDepartmentSessionAndLevel(
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
            data: ResultResource::collection($results),
            message: $results->count()
        );
    }

    public function resultsBySessionAndCourse(
        string $session,
        string $course
    ) {
        $session = Str::replace('-', '/', $session);

        $results = Result::query()
            ->where('session', $session)
            ->where('course_id', $course)
            ->get();

        return $this->respondWithSuccess(
            data: ResultResource::collection($results),
            message: $results->count()
        );
    }
}
