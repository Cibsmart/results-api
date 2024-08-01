<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
