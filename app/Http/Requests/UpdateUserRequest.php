<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'min:3'],
            'email' => ['sometimes', 'required', 'email', 'string', Rule::unique('users')->ignore($this->user->id)],
            'password' => [
                'sometimes',
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'type' => ['sometimes', 'required', Rule::in(['Admin', 'Employee'])],
            'phone' => ['min:8'],
            'job_id' => ['nullable', 'exists:jobs,id'],
            'description' => ['nullable', 'string']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
