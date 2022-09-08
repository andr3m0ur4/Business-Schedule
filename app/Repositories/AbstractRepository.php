<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectAttributes(Request $request)
    {
        if ($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $this->model = $this->model->select($attributes);
            return $this;
        }
    }

    public function filter(Request $request)
    {
        if ($request->has('filters')) {
            $filters = explode('|', $request->get('filters'));

            foreach ($filters as $filter) {
                $param = explode(',', $filter);
                $this->model = $this->model->where($param[0], $param[1], $param[2]);
            }
            return $this;
        }
    }

    public function getResults()
    {
        return $this->model->get();
    }
}
