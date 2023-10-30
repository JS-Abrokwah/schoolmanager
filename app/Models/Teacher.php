<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Admin;
use App\Models\Classes;
use App\Models\Subject;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'staff_id',
        'position'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function classes() {
        //Assigned as a class teacher
        return $this->belongsTo(Classes::class);
    }

    public function subjects() {
        //Assigned as a subject teacher
        return $this->belongsToMany(Subject::class,'subject_teacher','teacher_id','subject_id')
        ->using(SubjectTeacher::class)
        ->withPivot('active')
        ->withTimestamps();
    }
}
