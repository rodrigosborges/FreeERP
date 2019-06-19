<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome' => 'required|min:3|max:100',
          'cpf' => 'required',
          'email' => 'required|email|max:100',
          'data_nascimento' => 'required|date_format:d/m/Y',
          'sexo' => 'required',
          'celnumero' => 'required',
          'telefonenumero' => 'required|telefone'

        ];
    }

    // public function messages(){
    //     return [
    //         'nome.required' => 'O prontuário deve ter 7 digitos',
    //     ];
    // }

    public function authorize(){
        return true;
    }
}
