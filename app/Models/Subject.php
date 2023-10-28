<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Classes;
use App\Models\Teacher;
use Request;
use Auth;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'name',
        'type',
        'category',
        'created_by',
        'status',
    ];

    protected $casts = [
        'status'=>'boolean',
        'is_delete'=>'boolean'
    ];

    public function classes() {
        return $this->belongsToMany(Classes::class,'classes_subject','subject_id','classes_id')
        ->using(ClassesSubject::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();
    }

    public function teachers() {
        //Assigned as a subject teacher
        return $this->belongsToMany(Teacher::class,'subject_teacher','subject_id','teacher_id')
        ->using(SubjectTeacher::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();
    }

    public function programme(){
        return $this->belongsToMany(Programme::class,'programme_subject','subject_id','programme_id')
        ->using(ProgrammeSubject::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();
    }

    public function students(){
        return $this->belongsToMany(Student::class,'student_subject','subject_id','student_id')
        ->using(StudentSubject::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();
    }

    static public function subjectList(){
        $result = Subject::select('subjects.*','users.first_name as creator_first_name','users.last_name as creator_last_name')
                            ->join('users','users.id','subjects.created_by');

                            if(!empty(Request::get('search'))){
                                $result=$result->where('subjects.name','like','%'.Request::get('search').'%')
                                                ->orWhere(function($query){
                                                    $query->where('subjects.id','=',Request::get('search'));
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.type','like','%'.Request::get('search').'%');
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null);
                                                });

                            }
                        $result=$result->orderBy('subjects.id','desc')->paginate(10);
        return $result;   
    }

    static public function subjectsNotForClass($id){
        $result = Subject::whereDoesntHave('classes', function ($query) use($id){
            $query->where('classes_subject.classes_id','=',$id);
        })->get();
        return $result;
    }
    
    static public function subjectsNotForTeacher($id){
        $result = Subject::whereDoesntHave('teachers', function ($query) use($id){
            $query->where('subject_teacher.teacher_id','=',$id);
        })->get();
        return $result;
    }
}
