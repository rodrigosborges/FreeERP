<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest{
    public function rules(){
        return [
          'nome' => 'required|min:3'
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
