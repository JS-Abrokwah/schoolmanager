<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Student;
use App\Models\School;
use App\Models\Subject;
use App\Models\Programme;
use App\Models\ClassesSubject;
use Request;
use Auth;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'status',
    ];

    protected $casts = [
        'status'=>'boolean',
        'is_deleted'=>'boolean'
    ];

    public function admin(){
        return $this->belongsTo(User::class,'id');
    }

    public function students(){
        return $this->hasMany(Student::class)->withTrashed();
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class,'classes_subject','classes_id','subject_id')
        ->using(ClassesSubject::class)
        ->withPivot('active')
        ->withTimestamps()->withTrashed();
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function programme(){
        return $this->belongsTo(Programme::class);
    }
    static public function classList(){
        $result = Classes::whereHas('school',function ($query){
            $query->where('schools.id', '=',Auth::user()->school->id);
        });

                            if(!empty(Request::get('search'))){
                                $result=$result->where('classes.name','like','%'.Request::get('search').'%')
                                                ->orWhere(function($query){
                                                    $query->where('classes.id','=',Request::get('search'));
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('classes.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('classes.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null);
                                                });
                            }
                        $result=$result->whereHas('school',function ($query){
                            $query->where('schools.id', '=',Auth::user()->school->id);
                        })->orderBy('classes.id','desc')->paginate(10);
        
        return $result;   
    }

    public static function detail($id){
        $result = Classes::where('id','=',$id)->with('subjects')->get();       
        return $result;
    }
}
