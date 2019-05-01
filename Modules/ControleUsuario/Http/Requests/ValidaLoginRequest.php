<?php

namespace Modules\ControleUsuario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaLoginRequest extends FormRequest{
    public function rules(){
        return [
            'email'     => 'required|email',
            'password'  => 'required'
        ];
    }


    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!',
            'email' => 'Informe um email válido'
        ];
    }

    public function authorize(){
        return true;
    }
}
