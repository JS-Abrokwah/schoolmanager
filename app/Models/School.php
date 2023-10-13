<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}
