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
            'id' => ['required', 'string'],
            'start' => ['required', 'date_format:Y-m-d H:i:s'],
            'end' => ['required', 'date_format:Y-m-d H:i:s'],
            'mode' => ['required', Rule::in(['Ao Vivo', 'Gravado', 'Externa'])],
            'switcher_id' => ['required', 'exists:switchers,id'],
            'studio_id' => ['required', 'exists:studios,id'],
            'tv_show_id' => ['required', 'exists:tv_shows,id']
        ];
    }
}
