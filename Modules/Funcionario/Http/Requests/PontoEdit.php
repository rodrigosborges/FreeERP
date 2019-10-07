<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PontoEdit extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'stored.*'    => 'required|date_format:d/m/Y H:i:s',
            'entrada.*'    => 'required|date_format:d/m/Y H:i:s',
            'saida.*'    => 'required|date_format:d/m/Y H:i:s',
        ];
    }

    public function messages(){
        return [
            '*.date_format' => 'O campo deve conter uma data no formato válido.' 
        ];
    }
}
