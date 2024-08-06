<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    protected $hidden  = ['created_at','updated_at'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
