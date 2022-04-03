<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TvShowTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'start_time' => $this->start_time,
            'final_time' => $this->final_time,
            'date' => $this->date,
            'week_day' => $this->week_day,
            'mode' => $this->mode,
            'switcher' => $this->switcher,
            'studio' => $this->studio,
            'tv_show' => $this->tv_show,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
