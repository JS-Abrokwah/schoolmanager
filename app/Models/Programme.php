<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Student;

class Programme extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'certification',
        'description',
        'specialization',
        'status',
    ];

    protected $casts=[
        'status'=>'boolean'
    ];
// Relationships
    public function subjects() {
        return $this->belongsToMany(Subject::class,'programme_subject','programme_id','subject_id')
        ->using(ProgrammeSubject::class)
        ->withPivot('active')
        ->withTimestamps();
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

}
