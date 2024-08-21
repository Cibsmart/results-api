<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
        ]);

        if(count($data) === 0) {
            return $this->courses();
        }

        return $this->courseById($data['course_id']);
    }

    private function courseById($id)
    {
        $course = Course::query()->findOrFail($id);

        return is_null($course)
            ? $this->respondNotFound("Course not found")
            : $this->respondWithSuccess(data: new CourseResource($course), message: 'success');
    }

    private function courses(): JsonResponse
    {
        $courses = Course::all();

        return is_null($courses)
            ? $this->respondNotFound("Courses not found")
            : $this->respondWithSuccess(data: CourseResource::collection($courses), message: $courses->count());
    }
}
