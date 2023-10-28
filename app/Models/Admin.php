<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Student;

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
        return $this->hasMany(Teacher::class)->withTrashed();
    }
    public function parents(){
        return $this->hasMany(Parents::class)->withTrashed();
    }
    public function students(){
        return $this->hasMany(Student::class)->withTrashed();
    }

}
