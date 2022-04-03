<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvShow extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'file'];

    public function tv_show_times()
    {
        return $this->hasMany(TvShowTime::class);
    }
}
