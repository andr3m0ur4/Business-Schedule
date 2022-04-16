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
        return [
            'name' => ['sometimes', 'required', Rule::unique('tv_shows')->ignore($this->tv_show->id)]
            //'description' => [],
            //'file' => ['file', 'mimes:png,jpeg,pdf,docx']
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
            'required' => 'O campo nome é obrigatório.',
            'unique' => 'O nome já existe.',
            //'mimes' => 'O arquivo deve ser do tipo: png, jpeg, pdf, docx.'
        ];
    }
}
