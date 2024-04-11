<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto' => 'required',
            'nome' => 'required|max:120',
            'telefone' => 'required|max:11|min:10',
            'cpf' => 'required|max:11|min:10',
            'endereco' => 'required|max:120',
            'email' => 'required|max:120|email|unique:clientes,email',
            'password' => 'required',
        ];

        
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'foto.required' => 'O caompo é obrigatorio',
            'nome.required' => 'O campo nome é obrigatorio',
            'nome.max' => 'o campo nome deve conter no maximo 120 caracteres',
            'telefone.required' => 'Celular obrigatoria',
            'telefone.max' => 'Celular deve conter no maximo 11 caracteres',
            'telefone.min' => 'Celular deve conter no minimo 10 caracteres',
            'cpf.required' => ' obrigatoria',
            'cpf.max' => ' deve conter no maximo 11 caracteres',
            'cpf.min' => ' deve conter no minimo 10 caracteres',
            'email.max' => 'Email deve conter no maximo 120 caracteres',
            'email.required' => 'Email obrigatorio',
            'email.unique' => 'Email ja cadastrado no sistema',
            'email.email' => 'Formato invalido',
            'endereco.required' => 'Cidade obrigatoria',
            'endereco.max' => 'Cidade deve conter no maximo 120 caracteres',
            'password.required' => 'password obrigatorio',



        ];
    }
}
