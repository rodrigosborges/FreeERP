<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => ['required', 'min: 3', 'max: 45'],
            'preco' => ['required', 'numeric'],
            'descricao' => ['max: 500'],
            'codigo' => ['required', 'numeric', 'digits_between:8,13','unique:produto,codigo,'.$this->route('produto')]
        ];
    }

    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Máximo de :max caracteres!',
            'unique' => ':attribute já cadastrado!',
            'numeric' => 'Insira apenas valores númericos',
            'digits_between' => 'Insira entre 8 e 13 caracteres'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
