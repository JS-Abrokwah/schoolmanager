<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use Request;
use Auth;

class SchoolClass extends Model
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

    public function subjects(){
        return $this->belongsToMany(Subject::class,'school_classes_subjects', 'school_class_id','subject_id');
    }
    
    static public function classList(){
        $result = SchoolClass::select('school_classes.*','users.first_name as creator_first_name','users.last_name as creator_last_name')
                            ->where('school_classes.is_deleted','=',false)
                            ->join('users','users.id','school_classes.created_by');

                            if(!empty(Request::get('search'))){
                                $result=$result->where('school_classes.name','like','%'.Request::get('search').'%')
                                                ->where('school_classes.is_deleted','=',false)
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.id','=',Request::get('search'))
                                                    ->where('school_classes.is_deleted','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null)
                                                    ->where('school_classes.is_deleted','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null)
                                                    ->where('school_classes.is_deleted','=',false);
                                                });
                            }
                        $result=$result->orderBy('school_classes.id','desc')->paginate(10);
        
        return $result;   
    }
}
