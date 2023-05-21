<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "nome"=>"required | max:20",
                "descricao"=>"required | max:300",
                "qtd_estoque"=>"required | numeric | min:1",
                "preco"=>"required | numeric | min:1.99",
                "importado"=>"nullable | boolean",
                "fornecedor_id"=>"required | exists:fornecedores,id"
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => "O nome é obrigatório!!!",
            'nome.max' => "O limite de caracteres é 20!!"
        ];
    }
}
