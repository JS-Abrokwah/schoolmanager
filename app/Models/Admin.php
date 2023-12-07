<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Student;
use Auth;
use Request;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'staff_id',
        'position'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function parents(){
        return $this->hasMany(Parents::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }

    public static function adminList(){
        // This also allow search
        $result = Admin::whereHas('user', function ($query){
            $results=$query->where('school_id','=',Auth::user()->school->id);
            if(!empty(Request::get('search'))){
                $results=$query->where('first_name','like','%'.Request::get('search').'%')
                                ->where('email','!=',Auth::user()->email)
                                ->orWhere(function($query){
                                    $query->where('last_name','like','%'.Request::get('search').'%')
                                ->where('email','!=',Auth::user()->email)
                                    ;
                                })
                                ->orWhere(function($query){
                                    $query->where('email','like','%'.Request::get('search').'%')
                                    ->where('email','!=',Auth::user()->email)
                                    ;
                                })
                                ->orWhere(function($query){
                                    $query->where('sex','like','%'.Request::get('search').'%')
                                    ->where('email','!=',Auth::user()->email)
                                    ;
                                })
                                ->orWhere(function($query){
                                    $query->where('phone_no','like','%'.Request::get('search').'%')
                                    ->where('email','!=',Auth::user()->email)
                                    ;
                                })
                                ->orWhere(function($query){
                                    $query->where('id','=',Request::get('search'))
                                    ->where('email','!=',Auth::user()->email)
                                    ;
                                });
            }
            return $results;
        });
                    
        $result=$result->whereHas('user',function ($query){
            $query->where('school_id','=', Auth::user()->school->id)
            ->where('email','!=',Auth::user()->email);
        })
                    ->orderBy('id','desc')
                    ->paginate(10);
        return $result;
    }

}
