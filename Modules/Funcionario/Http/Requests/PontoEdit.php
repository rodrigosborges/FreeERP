<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PontoEdit extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'stored.*.entrada'          => 'required|date_format:d/m/Y H:i:s',
            'stored.*.saida'            => 'required|date_format:d/m/Y H:i:s',
            'stored.*.justificativa'    => 'min:3',
            'new.*.entrada'             => 'required|date_format:d/m/Y H:i:s',
            'new.*.saida'               => 'required|date_format:d/m/Y H:i:s',
            'new.*.justificativa'       => 'required|min:3',
        ];

        if($this->input('stored')){
            foreach($this->input('stored') as $key => $stored){
                $rules['stored.'.$key.'.saida'][] = 'date_after:'.$this->input('stored.'.$key.'.entrada');
            }
        }

        if($this->input('new')){
            foreach($this->input('new') as $key => $new){
                $rules['new.'.$key.'.saida'][] = 'date_after:'.$this->input('new.'.$key.'.entrada');
            }
        }

        return $rules;
    }

    public function messages(){
        return [
            '*.required'    => 'Este campo é obrigatório',
            '*.date_format' => 'Este campo deve conter uma data no formato válido.',
            '*.date_after'  => 'Este campo deve conter uma data maior que a data de entrada.',
            '*.min'         => 'Este campo deve conter no mínimo 3 dígitos.'
        ];
    }
}
