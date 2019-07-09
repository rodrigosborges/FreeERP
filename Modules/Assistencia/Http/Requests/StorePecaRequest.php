<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePecaRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            'nome' => 'required',
            'valor_compra' => 'required',
            'valor_venda' => 'required'
          ];
      }
  
      public function messages(){
          return [
            'nome.required' => 'Informe o nome da peça',
            'valor_compra.required' => 'Informe o valor da compra da peça',
            'valor_venda.required' => 'Informe o valor para venda'
          ];
      }
    public function authorize()
    {
        return true;
    }
}
