<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return $this->respondWithSuccess(
            data: DepartmentResource::collection($departments),
            message: $departments->count(),
        );
    }
}
