<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;

class ResponderAvaliacao extends FormRequest {

    public function rules() {
        
        return [
            'avaliado.email' => 'required|email',
            'avaliado.token' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.',
            'email' => 'Digite um email válido.'
        ];
    }
}