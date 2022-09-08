<?php

namespace App\Repositories;

use App\Models\TvShowTime;
use Illuminate\Http\Request;

class TvShowTimeRepository extends AbstractRepository
{
    public function __construct(TvShowTime $tvShowTime)
    {
        parent::__construct($tvShowTime);
    }

    public function selectAttributesRelational(Request $request)
    {
        if ($request->has('attributes_relational')) {
            $attributes = 'studio:id,' . $request->get('attributes_relational');
            $this->model = $this->model->with($attributes);
            return $this;
        }
    }
}
