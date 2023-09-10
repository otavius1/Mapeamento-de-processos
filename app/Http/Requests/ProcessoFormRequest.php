<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessoFormRequest extends FormRequest
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
            'processo' => 'required',
            'descricao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'processo.required' => 'O campo Nome do Processo deve ser preenchido',
            'descricao.required' => 'O campo Descrição do Processo deve ser preenchido',
        ];
    }
}