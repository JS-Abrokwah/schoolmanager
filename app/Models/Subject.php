<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;
use Request;
use Auth;

class Subject extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'type',
        'created_by',
        'status',
    ];

    protected $casts = [
        'status'=>'boolean',
        'is_delete'=>'boolean'
    ];

    public function schoolClasses(){
        return $this->belongsToMany(SchoolClass::class,'school_classes_subjects','subject_id','school_class_id');
    }

    static public function subjectList(){
        $result = Subject::select('subjects.*','users.first_name as creator_first_name','users.last_name as creator_last_name')
                            ->where('subjects.is_delete','=',false)
                            ->join('users','users.id','subjects.created_by');

                            if(!empty(Request::get('search'))){
                                $result=$result->where('subjects.name','like','%'.Request::get('search').'%')
                                                ->where('subjects.is_delete','=',false)
                                                ->orWhere(function($query){
                                                    $query->where('subjects.id','=',Request::get('search'))
                                                    ->where('subjects.is_delete','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.type','like','%'.Request::get('search').'%')
                                                    ->where('subjects.is_delete','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null)
                                                    ->where('subjects.is_delete','=',false);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('subjects.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null)
                                                    ->where('subjects.is_delete','=',false);
                                                });

                            }
                        $result=$result->orderBy('subjects.id','desc')->paginate(10);
        
        return $result;   
    }
}
