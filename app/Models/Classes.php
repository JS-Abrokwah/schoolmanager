<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    use HasFactory;

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
        return $this->hasMany(Student::class);
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class,'classes_subject','classes_id','subject_id')
        ->using(ClassesSubject::class)
        ->withPivot('active')
        ->withTimestamps();
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function programme(){
        return $this->belongsTo(Programme::class);
    }
    static public function classList(){
        $result = Classes::where('classes.is_deleted','=',false);

                            if(!empty(Request::get('search'))){
                                $result=$result->where('classes.name','like','%'.Request::get('search').'%')
                                                ->where('classes.is_deleted','=',false)
                                                ->orWhere(function($query){
                                                    $query->where('classes.id','=',Request::get('search'))
                                                    ->where('classes.is_deleted','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('classes.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null)
                                                    ->where('classes.is_deleted','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('classes.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null)
                                                    ->where('classes.is_deleted','=',false);
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
