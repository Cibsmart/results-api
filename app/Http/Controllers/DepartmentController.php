<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private const EXPECTED_KEYS = ['department_id'];

    public function __invoke(Request $request)
    {
        if(array_diff(array_keys($request->all()), self::EXPECTED_KEYS)) {
            return $this->respondError('Invalid parameter(s)');
        }

        $data = $request->validate([
            'department_id' => ['sometimes', 'string', 'regex:/^[0-9]+$/'],
        ]);

        if(count($data) === 0) {
            return $this->departments();
        }

        return $this->departmentById($data['department_id']);
    }

    private function departments(){
        $departments = Department::all();

        return $departments->isEmpty()
            ? $this->respondNotFound("Departments not found")
            : $this->respondWithSuccess(data: DepartmentResource::collection($departments), message: $departments->count(),);
    }

    private function departmentById($id)
    {
        $department = Department::query()->find($id);

        return is_null($department)
            ? $this->respondNotFound("Department not found")
            : $this->respondWithSuccess(data: new DepartmentResource($department), message: 'success');
    }
}
