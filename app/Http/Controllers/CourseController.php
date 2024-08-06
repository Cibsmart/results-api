<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::all();

        return $this->respondWithSuccess(
            data: CourseResource::collection($course),
            message: $course->count(),
        );
    }

    public function courseByCourseId($id)
    {
        return $this->respondWithSuccess(
            data: new CourseResource(Course::query()->findOrFail($id)),
            message: 'success',
        );
    }
}
