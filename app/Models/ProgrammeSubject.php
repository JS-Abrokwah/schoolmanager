<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgrammeSubject extends Pivot
{
    protected $fillable = [
        'programme_id',
        'subject_id',
        'active'
    ];
}
