<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Questao;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestao extends FormRequest {

    public function rules() {
        
        return [
            'questao.enunciado' => 'required',
            'questao.categoria_id' => 'required',
            'questao.opt1' => 'required',
            'questao.opt2' => 'required',
            'questao.opt3' => 'required',
            'questao.opt4' => 'required',
            'questao.opt5' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}