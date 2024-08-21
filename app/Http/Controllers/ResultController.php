<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResultResource;
use App\Models\Department;
use App\Models\Result;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    private const MAPPING = ['course_registration_id' => 'id'];

    public function __invoke(Request $request)
    {

        $validated = $request->validate([
            'registration_number' => ['sometimes', 'string', 'regex:/^EBSU\-\d{4}\-\d{4,6}[A-Z]?$/'],
            'department_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'course_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'course_registration_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
            'session' => ['sometimes', 'string', 'regex:/^\d{4}\-\d{4}$/'],
            'semester' => ['sometimes', 'string', 'in:FIRST,SECOND'],
            'level' => ['sometimes', 'string', 'regex:/^\d{3}$/'],
        ]);

        if(count($validated) === 0){
            return $this->results();
        }

        $department = array_key_exists('department_id', $validated)
            ? Department::find($validated['department_id'])
            : null;

        $filter = [];

        foreach($validated as $key => $value){
            if($key !== 'department_id') {
                $key = array_key_exists($key, self::MAPPING) ? self::MAPPING[$key] : $key;

                $filter[$key] = Str::replace('-', '/', $value);
            }
        }

        return $this->filterResults($department, $filter);
    }

    private function filterResults(?Department $department, array $filters)
    {
        $query = is_null($department)
            ? Result::query()
            : $department->results();

        $results = $query->where($filters)->get();

        return is_null($results)
            ? $this->respondNotFound('Results Not Found')
            : $this->respondWithSuccess(data: ResultResource::collection($results), message: $results->count(),);
    }

    private function results(): JsonResponse
    {
        $results = Result::query()->limit(100)->get();

        return is_null($results)
            ? $this->respondNotFound('Results Not Found')
            : $this->respondWithSuccess(data: ResultResource::collection($results), message: $results->count());
    }
}
