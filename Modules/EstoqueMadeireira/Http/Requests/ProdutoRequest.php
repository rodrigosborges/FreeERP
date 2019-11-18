<?php
namespace Modules\EstoqueMadeireira\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class ProdutoRequest extends FormRequest
{
    public function rules()
    {
        return [
            // 'nome' => ['required', 'min: 3', 'max: 40', 'unique:produto,nome,'.$this->route('produto')], 
            'nome' => ['required', 'min: 3', 'max: 40'],
            'tamanho' =>['max:8'],
            'preco' => ['required', 'numeric'],
            'descricao' => ['max: 500'],
        ];
    }
    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Máximo de :max caracteres!',
            'numeric' => 'Insira apenas valores númericos',
            // 'unique' => 'Produto já registrado!'
        ];
    }
    public function authorize()
    {
        return true;
    }
}