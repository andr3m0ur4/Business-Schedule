<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'type' => ['required', Rule::in(['Admin', 'Employee'])],
            'phone' => ['min:8'],
            'job_id' => ['exists:jobs,id'],
            'description' => ['string']
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
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'type.required' => 'O campo privilégio é obrigatório.',
            'email.unique' => 'O email já existe.',
            'confirmed' => 'As senhas são diferentes',
            'password.min' => 'O campo senha deve ter no minimo 8 caracteres',
            'phone.min' => 'O campo celular deve ter no minimo 8 caracteres'
        ];
    }
}
