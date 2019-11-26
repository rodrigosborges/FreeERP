<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Questao;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestao extends FormRequest {

    public function rules() {
        
        return [
            'questao.enunciado' => 'required',
            'questao.categoria_id' => 'required',
            'questao.descricao' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}