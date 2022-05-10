<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTime extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'start_time', 'end_time', 'date', 'week_day', 'user_id'];
}
