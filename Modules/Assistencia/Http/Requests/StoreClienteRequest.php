<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome' => 'required|min:3|max:100',
          'cpf' => 'required|cpf',
          'email' => 'required|email|max:100',
          'sexo' => 'required',
          'celnumero' => 'required',
          'telefonenumero' => 'required',
          'sexo' => 'required'

        ];
    }

    public function messages(){
        return [
          'nome.required' => 'Por favor, digite o nome do cliente',
          'cpf.required' => 'Por favor, digite o CPF do cliente',
          'cpf.cpf' => 'Por favor, difite um CPF valido',

          'celnumero' => 'Digine um numero de celular valido',
          'telefonenumero' => 'Digite um numero de telefone valido',
          'sexo.required' => 'Selecione o sexo do cliente'

        ];
    }

    public function authorize(){
        return true;
    }
}
