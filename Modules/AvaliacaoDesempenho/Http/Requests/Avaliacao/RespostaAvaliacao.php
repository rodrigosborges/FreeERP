<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;

class RespostaAvaliacao extends FormRequest {

    public function rules() {
        
        return [
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}