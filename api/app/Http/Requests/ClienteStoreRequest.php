<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'cpf' => 'required|max:14|unique:clientes,cpf',
            'nascimento' => 'required|date',
            'telefone' => 'required|max:11',
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
