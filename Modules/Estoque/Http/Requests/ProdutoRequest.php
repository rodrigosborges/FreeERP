<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => ['required', 'min: 3', 'max: 45'],
            'preco_venda' => ['required', 'numeric'],
            'descricao' => ['max: 500']
        ];
    }

    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Minimo de :max caracteres!',
            'unique' => ':attribute já cadastrado!',
            'numeric' => 'Insira apenas valores númericos'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
