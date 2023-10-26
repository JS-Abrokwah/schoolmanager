<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSubject extends Pivot
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'active'
    ];
}
