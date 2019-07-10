<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome' => 'required|min:3|max:100',
          'cpf' => 'required|cpf',
          'email' => 'required|email|max:100',
          'data_nascimento' => 'required|max:10',
          'sexo' => 'required',
          'celnumero' => 'required|min:14|max:15',
          'telefonenumero' => 'required|min:14|max:15',
          'sexo' => 'required'

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
          'sexo.required' => 'Selecione o sexo do cliente.'

        ];
    }

    public function authorize(){
        return true;
    }
}
