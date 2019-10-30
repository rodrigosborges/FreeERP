<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        $time = strtotime('-18 year', time());
        $date = date('Y-m-d', $time);

        return [
          'nome'                    => 'required|min:3|max:100',
          'cpf'                     => 'required|cpf|unique:cliente_assistencia,cpf,'.$this->route('id'),
          'email'                   => 'required|email|max:100',
          'data_nascimento'         => 'required|max:10|before_or_equal:'.$date,
          'celnumero'               => 'required|min:14|max:15',
          'endereco.logradouro'     => 'required',
          'endereco.bairro'         => 'required',
          'endereco.estado_id'      => 'required',
          'endereco.numero'         => 'required',
          'endereco.cidade_id'      => 'required',
      

        ];
    }

    public function messages(){
        return [
            'required'          => 'Este campo é obrigatório.',
            'min'               => 'Informação inserida abaixo do valor mínimo.',
            'max'               => 'Informação inserida maior do que o valor maximo exigido.',
            'email'             => 'E-mail incorreto.',
            'cpf'               => 'C.P.F inválido.',
            'unique'            => 'Informação já inserida na base de dados.',
            'before_or_equal'   => 'O cliente deve ter 18 anos ou mais.'
        ];  
    }

    public function authorize(){
        return true;
    }
}
