<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
    ];

    public function admin(){
        return $this->belongsTo(User::class,'id');
    }
    
    static public function classList(){
        $result = SchoolClass::select('school_classes.*','users.first_name as creator_first_name','users.last_name as creator_last_name')
                            ->where('school_classes.is_deleted','=',false)
                            ->join('users','users.id','school_classes.created_by');

                            if(!empty(Request::get('search'))){
                                $result=$result->where('school_classes.name','like','%'.Request::get('search').'%')
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.id','=',Request::get('search'));
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.status','=',(Request::get('search')=="Active"||Request::get("active"))?true:null);
                                                })
                                                ->orWhere(function($query){
                                                    $query->where('school_classes.status','=',(Request::get('search')=="Inactive"||Request::get("inactive"))?false:null);
                                                });
                            }
                            $result=$result->where('school_classes.is_deleted','=',false)
                            ->orderBy('school_classes.id','desc')
                            ->paginate(10);
        
        return $result;   
    }
}
