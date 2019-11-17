<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Questao;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestao extends FormRequest {

    public function rules() {
        
        return [
            'questao.enunciado' => 'required',
            'questao.categoria_id' => 'required',
            'questao.opt1' => 'required|numeric',
            'questao.opt2' => 'required|numeric',
            'questao.opt3' => 'required|numeric',
            'questao.opt4' => 'required|numeric',
            'questao.opt5' => 'required|numeric'
        ];
    }

    public function attributes() {

        return [
            'questao.opt1' => 'Opção 1',
            'questao.opt2' => 'Opção 2',
            'questao.opt3' => 'Opção 3',
            'questao.opt4' => 'Opção 4',
            'questao.opt5' => 'Opção 5'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}