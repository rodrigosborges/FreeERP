<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Setor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSetor extends FormRequest {

    public function rules() {
        
        return [
            'setor.nome' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}