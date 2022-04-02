<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTvShowRequest extends FormRequest
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
        $rules = [
            'name' => ['required', Rule::unique('tv_shows')->ignore($this->tv_show->id)],
            'description' => []
        ];

        if ($this->method() === 'PATCH') {
            $customRules = [];

            foreach ($rules as $input => $rule) {
                if (array_key_exists($input, $this->request->all())) {
                    $customRules[$input] = $rule;
                }
            }

            return $customRules;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo nome é obrigatório.',
            'unique' => 'O nome já existe.'
        ];
    }
}
