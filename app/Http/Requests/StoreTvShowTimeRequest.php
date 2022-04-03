<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTvShowTimeRequest extends FormRequest
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
            'start_time' => ['required', 'date_format:H:i:s,H:i'],
            'final_time' => ['required', 'date_format:H:i:s,H:i'],
            'date' => ['required', 'date_format:Y-m-d'],
            'week_day' => ['required', 'integer', 'between:0,6'],
            'mode' => ['required', Rule::in(['Ao Vivo', 'Gravado', 'Externa'])],
            'switcher_id' => ['required', 'exists:switchers,id'],
            'studio_id' => ['required', 'exists:studios,id'],
            'tv_show_id' => ['required', 'exists:tv_shows,id']
        ];
    }
}
