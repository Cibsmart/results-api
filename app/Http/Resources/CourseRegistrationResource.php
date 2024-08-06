<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseRegistrationResource extends JsonResource
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
            'registration_number' => $this->registration_number,
            'session' => $this->session,
            'semester' => $this->semester,
            'level' => $this->level,
            'course_id' => $this->course->id,
            'credit_unit' => $this->credit_unit,
            'registration_date' => $this->created_at
        ];
    }
}
