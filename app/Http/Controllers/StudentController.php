<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public const MAPPING = [
        'registration_number' => 'registration_number',
        'department_id' => 'department_id',
        'session' => 'entry_session',
    ];

    private const EXPECTED_KEYS = ['registration_number', 'department_id', 'session'];

    public function __invoke(Request $request)
    {
        if(array_diff(array_keys($request->all()), self::EXPECTED_KEYS)) {
            return $this->respondError('Invalid parameter(s)');
        }

        $validated = $request->validate([
            'registration_number' => ['sometimes', 'string', 'regex:/^EBSU\-\d{4}\-\d{4,6}[A-Z]?$/'],
            'department_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'session' => ['sometimes', 'string', 'regex:/^\d{4}\-\d{4}$/'],
        ]);

        if(count($validated) === 0){
            return $this->students();
        }

        $filter = [];

        foreach($validated as $key => $value){
            $filter[self::MAPPING[$key]] = Str::replace('-', '/', $value);
        }

        return $this->filterStudents($filter);
    }

    private function filterStudents(array $filter)
    {
        $students = Student::query()->where($filter)->get();

        return $students->isEmpty()
            ? $this->respondNotFound('Students not found')
            : $this->respondWithSuccess(data: StudentResource::collection($students), message: $students->count());
    }

    private function students(): JsonResponse
    {
        $students = Student::query()->limit(100)->get();

        return $students->isEmpty()
            ? $this->respondNotFound('Students not found')
            : $this->respondWithSuccess(data: StudentResource::collection($students), message: $students->count());
    }

}
