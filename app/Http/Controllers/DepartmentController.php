<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return $this->respondWithSuccess(
            data: DepartmentResource::collection(Department::all()),
            message: 'success',
        );
    }
}
