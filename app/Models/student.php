<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'gender', 'email', 'phone', 'address', 'class', 'photo'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',  
        'expires_at' => 'datetime:Y-m-d H:i:s'      
    ];
}