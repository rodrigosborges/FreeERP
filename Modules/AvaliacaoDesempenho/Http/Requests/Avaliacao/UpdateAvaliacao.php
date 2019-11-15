<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAvaliacao extends FormRequest {

    public function rules() {
        
        $today = date('d/m/Y');
        
        return [
            'avaliacao.nome' => 'required',
            'avaliacao.data_inicio' => 'required|date_format:d/m/Y|after_or_equal:'.$today,
            'avaliacao.data_fim' => 'required|date_format:d/m/Y|after_or_equal:'.$today,
            'avaliacao.processo_id' => 'required',
            'avaliacao.funcionario_id' => 'required',
            'avaliacao.setor_id' => 'required',
            'avaliacao.tipo_id' => 'required'
        ];
    }

    public function attributes() {

        return [
            'avaliacao.data_inicio' => 'data inicio',
            'avaliacao.data_fim' => 'data fim'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}