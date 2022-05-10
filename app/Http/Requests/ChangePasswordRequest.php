<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePasswordRequest extends FormRequest
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
            'password' => [
                'required',
                'confirmed',
                'sometimes'
                // Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'email' => ['sometimes', 'required', 'email', 'string'],
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
            'required' => 'O campo :attribute é obrigatório.',
            //'on_null' => ':attribute não encontrado',
            'email' => ':attribute tem que ser valído'
           //'mimes' => 'O arquivo deve ser do tipo: png, jpeg, pdf, docx.'
        ];
    }

}
