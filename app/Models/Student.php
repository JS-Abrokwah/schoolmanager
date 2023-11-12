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
use Auth;
use Request;


class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_of_birth',
        'admission_date',
        'admission_number',
        'index_number',
        'roll_number',
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
        return $this->belongsTo(Classes::class);
    }

    public function programme(){
        return $this->belongsTo(Programme::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'student_subject','student_id','subject_id')
        ->using(StudentSubject::class)
        ->withPivot('active')
        ->withTimestamps();  
    }

    public static function studentsList() {
        $result = Student::whereHas('user',function ($query){
            $results = $query->where('school_id','=',Auth::user()->school->id);
            if(!empty(Request::get('search'))){
               $results = $query->where('first_name','like','%'.Request::get('search').'%')
                                ->orWhere(function($query){
                                    $query->where('last_name','like','%'.Request::get('search').'%');
                                })
                                ->orWhere(function($query){
                                    $query->where('email','like','%'.Request::get('search').'%');
                                })
                                ->orWhere(function($query){
                                    $query->where('sex','like','%'.Request::get('search').'%');
                                });                                
            }
            return $results;
        });
        if(!empty(Request::get('search'))){
            $result = $result->orWhere(function ($query){
                $query->where('admission_number','like','%'.Request::get('search').'%');
            })
            ->orWhere(function($query){
                $query->where('index_number','like','%'.Request::get('search').'%');
            });                                
         }          
        $result=$result->whereHas('user',function ($query){
            $results = $query->where('school_id','=',Auth::user()->school->id);
        })
                    ->orderBy('id','desc')
                    ->paginate(10);
        return $result;
    }

    public static function findStudent($id){
        return Student::with('user')->find($id);
    }
}
