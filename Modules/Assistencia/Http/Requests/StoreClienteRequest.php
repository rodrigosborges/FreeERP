<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome' => 'required|min:3|max:100',
          'cpf' => 'required|cpf',
          'email' => 'required|email|max:100',
          'sexo' => 'required'
        ];
    }

    public function messages(){
        return [
          'nome.required' => 'Por favor, digite o nome do cliente',
          'cpf.required' => 'Por favor, digite o CPF do cliente',
          'cpf.cpf' => 'Por favor, difite um CPF valido',
          'sexo.required' => 'Selecione o sexo do cliente'
        ];
    }

    public function authorize(){
        return true;
    }
}
