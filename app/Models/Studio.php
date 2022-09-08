<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function tv_show_times()
    {
        return $this->hasMany(TvShowTime::class);
    }
}
