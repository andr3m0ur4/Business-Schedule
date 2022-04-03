<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvShowTime extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['start_time', 'final_time', 'date', 'week_day', 'mode', 'switcher_id', 'studio_id', 'tv_show_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function switcher()
    {
        return $this->belongsTo(Switcher::class);
    }

    public function tv_show()
    {
        return $this->belongsTo(TvShow::class);
    }
}
