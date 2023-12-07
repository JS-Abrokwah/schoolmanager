<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassesSubject extends Pivot
{
    use SoftDeletes;
    protected $fillable = [
        'classes_id',
        'subject_id',
        'active'
    ];
}
