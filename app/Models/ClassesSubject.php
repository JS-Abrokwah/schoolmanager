<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassesSubject extends Pivot
{

    protected $fillable = [
        'classes_id',
        'subject_id',
        'active'
    ];
}
