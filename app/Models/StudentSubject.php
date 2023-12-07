<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSubject extends Pivot
{
    use SoftDeletes;
    protected $fillable = [
        'student_id',
        'subject_id',
        'active'
    ];
}
