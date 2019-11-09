<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

use Modules\AvaliacaoDesempenho\Entities\Avaliacao;

class RespostaAvaliacao extends FormRequest {
    
    public function rules() {
        
        $input = $this->input('avaliacao');
        
        Validator::extend('valid_avaliacao', function($attribute, $value, $parametes) use($input) {
            $avaliacao = Avaliacao::findOrFail($input['avaliacao_id']);

            if (count($input['questoes']) == count($avaliacao->questoes)) {
                return true;
            } else {
                return false;
            }
        });
        
        return [
            'avaliacao' => 'valid_avaliacao',
            'avaliacao.questoes' => 'required',
            'avaliacao.questoes.*' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.',
            'valid_avaliacao' => 'É obrigatorio responder todas as questões antes de submeter o formulário'
        ];
    }
}