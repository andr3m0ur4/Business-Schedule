<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_time_id', 'tv_show_time_id'];

    public function tv_show_time()
    {
        return $this->belongsTo(TvShowTime::class);
    }
}
