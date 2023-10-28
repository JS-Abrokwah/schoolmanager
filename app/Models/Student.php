<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Admin;
use App\Models\Parents;
use App\Models\Programme;
use App\Models\Classes;


class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_of_birth',
        'admission_date',
        'admission_number',
        'index_number',
        'roll_number',
        'programme_of_study',
        'residence',
        'house',
        'last_school_attended',
    ];

    protected $casts = [
        'date_of_birth'=>'date',
        'admission_date'=>'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function guardian() {
        return $this->belongsTo(Parents::class);
    }

    public function classes() {
        $this->belongsTo(Classes::class);
    }

    public function programme(){
        return $this->belongsTo(Programme::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'student_subject','student_id','subject_id')
        ->using(StudentSubject::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();  
    }
}
