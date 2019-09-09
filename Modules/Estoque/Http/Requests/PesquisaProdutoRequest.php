<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesquisaProdutoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'preco_min' => ['numeric', 'nullable'],
            'preco_max' => ['numeric', 'nullable'],
        ];
    }

    public function messages(){
        return[
            'numeric' => 'Insira apenas valores númericos',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
