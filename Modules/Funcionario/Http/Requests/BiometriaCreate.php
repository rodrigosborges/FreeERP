<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiometriaCreate extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'biometria'    => 'required',
        ];
    }
}
