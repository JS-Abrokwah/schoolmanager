<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgrammeSubject extends Pivot
{
    use SoftDeletes;
    protected $fillable = [
        'programme_id',
        'subject_id',
        'active'
    ];
}
