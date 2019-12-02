<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class RespostaAvaliacao extends FormRequest {
    
    public function rules() {
        
        return [
            'avaliacao.questoes' => 'required',
            'avaliacao.questoes.*' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Todas as questões são obrigatorias.'
        ];
    }
}