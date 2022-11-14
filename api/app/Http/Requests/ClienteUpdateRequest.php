<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'max:255',
            'cpf' => 'max:14|unique:clientes,cpf',
            'nascimento' => 'date',
            'telefone' => 'max:11',
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Já existe um cliente com este CPF',
            'cpf.max' => 'Formato de CPF inválido',
        ];
    }
}
