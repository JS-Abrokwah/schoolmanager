<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\School;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Student;
use Auth;

class Programme extends Model
{
    use HasFactory, SoftDeletes;

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
        ->withTimestamps()->withTrashed();
    }

    public function classes() {
        return $this->hasMany(Classes::class)->withTrashed();
    }

    public function students(){
        return $this->hasMany(Student::class)->withTrashed();
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public static function programmeList(){
        
        $result = Programme::whereHas('school', function ($query){
            $query->where('schools.id','=',Auth::user()->school->id);
        })->paginate(10);
        return $result;
    }

    public static function allProgrammes(){
        $result = Programme::whereHas('school', function ($query){
            $query->where('schools.id','=',Auth::user()->school->id);
        })->get();

        return $result;
    }
}
