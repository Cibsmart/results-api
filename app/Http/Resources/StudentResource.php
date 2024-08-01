<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'other_names' => $this->other_names,
            'registration_number' => $this->registration_number,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'department_id' => $this->department_id,
            'option' => $this->option,
            'state' => $this->state,
            'local_government' => $this->local_government,
            'entry_session' => $this->entry_session,
            'entry_mode' => $this->entry_mode,
            'entry_level' => $this->entry_level,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
        ];
    }
}
