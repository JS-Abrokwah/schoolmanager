<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\SchoolClass;
use Request;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function schoolClasses(){
        return $this->hasMany(SchoolClass::class,'created_by');
    }

    static public function getEmailSingle($email){
        return User::where('email','=',$email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token','=',$remember_token)->first();
    }
    
    static public function adminList(){
        // This also allow search
        $result = User::where('user_type','=','Admin');
                    if(!empty(Request::get('search'))){
                        $result=$result->where('first_name','like','%'.Request::get('search').'%')
                                        ->orWhere(function($query){
                                            $query->where('last_name','like','%'.Request::get('search').'%');
                                        })
                                        ->orWhere(function($query){
                                            $query->where('email','like','%'.Request::get('search').'%');
                                        })
                                        ->orWhere(function($query){
                                            $query->where('id','=',Request::get('search'));
                                        });
                    }
        $result=$result->where('user_type','=','Admin')
                    ->where('is_deleted','=',false)
                    ->where('email','!=',Auth::user()->email)
                    ->orderBy('id','desc')
                    ->paginate(10);
        return $result;
    }
}
