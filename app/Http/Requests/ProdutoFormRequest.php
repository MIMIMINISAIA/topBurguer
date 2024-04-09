<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequest extends FormRequest
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
            'nome' => 'required|max:120',
            'valor' => 'required|max:200',
            'descricao' => 'required|max:200',
            'imagem' => 'required',
           
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
            'nome.required' => 'O campo nome é obrigatorio',
            'nome.max' => 'o campo nome deve conter no maximo 120 caracteres',
            'valor.required' => 'preço obrigatorio',
            'valor.max' => ' deve conter no maximo 200 caracteres',
            'descricao.max' => ' deve conter no maximo 200 caracteres',
            'descricao.required' => 'obrigatorio',
            'imagem.required' => 'imagem obrigatoria',
         



        ];
    }
}
