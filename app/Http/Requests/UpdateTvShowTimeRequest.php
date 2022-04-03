<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTvShowTimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_time' => ['sometimes', 'required', 'date_format:H:i:s,H:i'],
            'final_time' => ['sometimes', 'required', 'date_format:H:i:s,H:i'],
            'date' => ['sometimes', 'required', 'date_format:Y-m-d'],
            'week_day' => ['sometimes', 'required', 'integer', 'between:0,6'],
            'mode' => ['sometimes', 'required', Rule::in(['Ao Vivo', 'Gravado', 'Externa'])],
            'switcher_id' => ['sometimes', 'required', 'exists:switchers,id'],
            'studio_id' => ['sometimes', 'required', 'exists:studios,id'],
            'tv_show_id' => ['sometimes', 'required', 'exists:tv_shows,id']
        ];
    }
}
