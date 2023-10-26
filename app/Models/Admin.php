<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Student;

class Admin extends Model
{
    use HasFactory;

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

}
