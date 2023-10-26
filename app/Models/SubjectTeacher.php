<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectTeacher extends Pivot
{
    //
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'active'
    ];
}
