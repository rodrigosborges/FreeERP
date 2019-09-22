<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreProcesso extends FormRequest {

    public function rules() {
        
        return [
            'processo.funcionario_id' => 'required',
            'processo.data_inicio' => 'required',
            'processo.data_fim' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}