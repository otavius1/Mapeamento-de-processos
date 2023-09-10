<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollabFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'matricula' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome deve ser preenchido',
            'email.required' => 'O campo email deve ser preenchido',
            'email.email' => 'O campo email deve ter um formato valido',
            'matricula.required' => 'O campo matrícula deve ser preenchido',
            'matricula.numeric' => 'O campo matrícula deve ter um formato válido',
        ];
    }
}


