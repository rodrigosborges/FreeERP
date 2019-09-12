<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentacaoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'preco_custo' => ['numeric'],
            'observacao' => ['max: 200', 'required'],
            'quantidade' => ['numeric','required']
        ];
    }

    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'max' => 'Máximo de :max caracteres!',
            'numeric' => 'Insira apenas valores númericos'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
