<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::query()->limit(100)->get();

        return $this->respondWithSuccess(
            data: StudentResource::collection($students),
            message: $students->count(),
        );
    }

    public function studentByRegistrationNumber(string $registrationNumber)
    {
        $registrationNumber = Str::replace('-', '/', $registrationNumber);

        return $this->respondWithSuccess(
            data: new StudentResource(Student::query()
                ->where('registration_number', $registrationNumber)
                ->firstOrFail()
            ),
            message: 'success',
        );
    }

    public function studentsByDepartmentAndSession(Department $department, string $session)
    {
        $session = Str::replace('-', '/', $session);

        $students = $department->students()
            ->where('entry_session', $session)
            ->get();

        return $this->respondWithSuccess(
            data: StudentResource::collection($students),
            message: $students->count()
        );

    }

    public function studentsBySession(string $session)
    {
        $session = Str::replace('-', '/', $session);

        $students = Student::query()
            ->where('entry_session', $session)
            ->get();

        return $this->respondWithSuccess(
            data: StudentResource::collection($students),
            message: $students->count()
        );

    }

    public function passportWithId(string $id)
    {
        return new JsonResponse(
            data: ["data" => "lorem ipsum", "status" => true, "message" => "success"],
        );
    }

    public function passportWithRegistrationNumber(string $registrationNumber)
    {
        return new JsonResponse(
            data: ["data" => "lorem ipsum", "status" => true, "message" => "success"],
        );
    }

}
