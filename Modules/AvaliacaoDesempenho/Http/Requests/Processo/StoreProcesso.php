<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Processo;
use Illuminate\Foundation\Http\FormRequest;

class StoreProcesso extends FormRequest {

    public function rules() {
        
        return [
            'processo.nome' => 'required',
            'processo.funcionario_id' => 'required',
            'processo.data_inicio' => 'required|date_format:d/m/Y',
            'processo.data_fim' => 'required|date_format:d/m/Y'
        ];
    }

    public function attributes() {

        return [
            'processo.data_inicio' => 'data inicio',
            'processo.data_fim' => 'data fim'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}