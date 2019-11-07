<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;

class StoreAvaliacao extends FormRequest {

    public function rules() {

        return [
            'avaliacao.nome' => 'required',
            'avaliacao.data_inicio' => 'required|date_format:d/m/Y',
            'avaliacao.data_fim' => 'required|date_format:d/m/Y',
            'avaliacao.processo_id' => 'required',
            'avaliacao.funcionario_id' => 'required',
            'avaliacao.setor_id' => 'required',
            'avaliacao.tipo_id' => 'required',
            'avaliacao.questoes' => 'required',
            'avaliacao.questoes.*' => 'distinct'
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
            'required' => 'Este campo é obrigatorio.',
            'distinct' => 'Só é possivel cadastrar uma unica vez cada questão.'
        ];
    }
}
