<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTeacher extends Pivot
{
    use SoftDeletes;
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'active'
    ];
}
