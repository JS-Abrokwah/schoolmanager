<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Programme;
use App\Models\Classes;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'waec_id',
        'ownership',
        'gender',
        'town',
        'district',
        'region',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function classes(){
        return $this->hasMany(Classes::class);
    }

    public function programmes(){
        return $this->hasMany(Programme::class);
    }
}
