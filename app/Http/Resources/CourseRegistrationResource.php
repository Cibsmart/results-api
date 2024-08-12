<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CourseRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        [$day, $month, $year] = $this->created_at !== ""
            ? Str::of($this->created_at->format('d-m-Y'))->explode('-')
            : ["", "", ""];

        return [
            'id' => (string) $this->id,
            'registration_number' => $this->registration_number,
            'session' => $this->session,
            'semester' => $this->semester,
            'level' => $this->level,
            'course_id' => (string) $this->course->id,
            'credit_unit' => $this->credit_unit,
            'registration_date' => compact('day', 'month', 'year'),
        ];
    }
}
