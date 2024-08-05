<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'course_registration_id' => $this->id,
            'registration_number' => $this->registration_number,
            'in_course' => $this->in_course,
            'exam_score' => $this->exam,
            'total_score' => $this->total,
            'grade' => $this->grade,
            'upload_date' => $this->updated_at
        ];
    }
}
