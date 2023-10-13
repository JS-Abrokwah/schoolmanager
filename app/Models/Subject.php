<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
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

    public function classes() {
        return $this->belongsToMany(Classes::class,'classes_subject','subject_id','classes_id')
        ->using(ClassesSubject::class)
        ->withPivot('active')
        ->withTimestamps();
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

    static public function subjectsNotForClass($id){
        $result = Subject::whereDoesntHave('classes', function ($query) use($id){
            $query->where('classes_subject.classes_id','=',$id);
        })->where('subjects.is_delete',false)->get();

        return $result;
    }
}
