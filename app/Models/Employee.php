<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends User
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'job',
        'description'
    ];
}
