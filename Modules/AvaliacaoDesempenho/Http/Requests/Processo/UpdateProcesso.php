<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Processo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProcesso extends FormRequest {

    public function rules() {

        $today = date('d/m/Y');

        return [
            'processo.nome' => 'required',
            'processo.funcionario_id' => 'required',
            'processo.data_inicio' => 'required|date_format:d/m/Y|after_or_equal:'.$today,
            'processo.data_fim' => 'required|date_format:d/m/Y|after_or_equal:'.$today
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