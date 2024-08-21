<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'course_registration_id' => (string) $this->id,
            'registration_number' => $this->registration_number,
            'in_course' => $this->in_course,
            'exam_score' => $this->exam,
            'total_score' => $this->total,
            'grade' => $this->grade,
            'upload_date' => $this->updated_at ? $this->updated_at->toJSON() : '',
            'exam_date' => $this->updated_at ? $this->updated_at->toJSON() : '',
            'lecturer_name' => fake()->name,
            'lecturer_department' => fake()->randomElement(Department::all()->pluck('id')->toArray()),
        ];
    }
}
