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
          'telefonenumero'          => 'min:14|max:15',
          'endereco.logradouro'     => 'required',
          'endereco.bairro'         => 'required',
          'endereco.estado_id'      => 'required',
          'endereco.numero'         => 'required',
          'endereco.cidade_id'      => 'required',
      

        ];
    }

    public function messages(){
        return [
          'nome.required' => 'Por favor, digite o nome do cliente.',
          'cpf.required' => 'Por favor, digite o CPF do cliente.',
          'data_nascimento' => 'Data de nascimento invalida.',
          'cpf.cpf' => 'Por favor, difite um CPF valido.',
          'data_nascimento.max' => 'Data de nascimento invalida',
          'celnumero.min' => 'O campo de telefone deve possuir apenas o DDD e o numero',
          'telefonenumero.min' => 'O campo de telefone deve possuir apenas o DDD e o numero',
          'celnumero.max' => 'O campo de telefone deve possuir apenas o DDD e o numero',
          'telefonenumero.max' => 'O campo de telefone deve possuir apenas o DDD e o numero',
          'celnumero.required' => 'Digine um numero de celular valido.',
          'telefonenumero.max' => 'Digite um numero de telefone valido.',

        ];
    }

    public function authorize(){
        return true;
    }
}
