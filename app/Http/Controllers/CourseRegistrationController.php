<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseRegistrationResource;
use App\Models\Department;
use App\Models\Result;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseRegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => ['sometimes', 'string', 'regex:/^EBSU\-\d{4}\-\d{4,6}[A-Z]?$/'],
            'department_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'course_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'session' => ['sometimes', 'string', 'regex:/^\d{4}\-\d{4}$/'],
            'semester' => ['sometimes', 'string', 'in:FIRST,SECOND'],
            'level' => ['sometimes', 'string', 'regex:/^\d{3}$/'],
        ]);

        if(count($validated) === 0){
            return $this->registrations();
        }

        $department = array_key_exists('department_id', $validated)
            ? Department::find($validated['department_id'])
            : null;

        $filter = [];

        foreach($validated as $key => $value){
            if($key !== 'department_id') {
                $filter[$key] = Str::replace('-', '/', $value);
            }
        }

        return $this->filterRegistration($department, $filter);
    }

    private function filterRegistration(?Department $department, array $filters)
    {
        $query = is_null($department)
            ? Result::query()
            : $department->results();

        $registrations = $query->where($filters)->get();

        return is_null($registrations)
            ? $this->respondNotFound('Course Registration Not Found')
            : $this->respondWithSuccess(data: CourseRegistrationResource::collection($registrations), message: $registrations->count(),);
    }

    private function registrations(): JsonResponse
    {
        $registrations = Result::query()->limit(100)->get();

        return is_null($registrations)
            ? $this->respondNotFound('Course Registrations Not Found')
            : $this->respondWithSuccess(
                data: CourseRegistrationResource::collection($registrations),
                message: $registrations->count(),
            );
    }
}
