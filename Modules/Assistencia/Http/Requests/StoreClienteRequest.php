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
          'celnumero' => 'required|telefone',
          'telefonenumero' => 'required|telefone'
        ];
    }

    public function messages(){
        return [
          'nome.required' => 'Por favor, digite o nome do cliente',
          'cpf.required' => 'Por favor, digite o CPF do cliente',
          'cpf.cpf' => 'Por favor, difite um CPF valido',
          'celnumero.telefone' => 'Digine um numero de celular valido',
          'telefonenumero.telefone' => 'Digite um numero de telefone valido'
        ];
    }

    public function authorize(){
        return true;
    }
}
