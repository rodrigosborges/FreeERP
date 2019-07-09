<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicoRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'nome' => 'required',
            'valor' => 'required'
          ];
      }
  
      public function messages(){
          return [
            'nome.required' => 'Informe o nome do serviço/mão-de-obra',
            'valor.required' => 'Informe o valor da mão-de-obra'
          ];
      }
    public function authorize()
    {
        return true;
    }
}
