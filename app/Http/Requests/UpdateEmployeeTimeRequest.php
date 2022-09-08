<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeTimeRequest extends FormRequest
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
            'id' => ['sometimes', 'required', 'string'],
            'start' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
            'end' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
            'user_id' => ['sometimes', 'required', 'exists:users,id'],
        ];
    }
}
