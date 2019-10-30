<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome'                    => 'required|min:3|max:100',
          'cpf'                     => 'required|cpf|unique:cliente_assistencia,cpf,'.$this->route('id'),
          'email'                   => 'required|email|max:100',
          'data_nascimento'         => 'required|max:10',
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
            'required'      => 'Este campo é obrigatório.',
            'min'           => 'Valor inserido abaixo do valor mínimo.',
            'max'           => 'Valor inserido maior do que o valor máximo.',
            'email'         => 'E-mail incorreto.',
            'cpf'           => 'C.P.F inválido.',
            'unique'        => 'Valor já inserido na base de dados.',

        ];
    }

    public function authorize(){
        return true;
    }
}
