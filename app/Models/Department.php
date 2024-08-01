<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected function casts()
    {
        return [
            'options' => 'array',
        ];
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function results()
    {
        return $this->hasManyThrough(Result::class, Student::class);
    }
}

