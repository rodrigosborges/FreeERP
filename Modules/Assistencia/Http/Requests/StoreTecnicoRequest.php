<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTecnicoRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:100',
            'cpf' => 'required|cpf'
          ];
      }
  
      public function messages(){
          return [
            'nome.required' => 'Por favor, digite o nome do tecnico',
            'cpf.required' => 'Por favor, digite o CPF do tecnico',
            'cpf.cpf' => 'Por favor, difite um CPF valido'        
          ];
      }
}
