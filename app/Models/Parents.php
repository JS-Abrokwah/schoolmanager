<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;


class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupation',
        'relation_to_student',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }
}
