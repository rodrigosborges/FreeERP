<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCargo extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->route('cargo');
        return [
            'nome'              => 'required|max:100|unique:cargo,nome,'.$id,
            'horas_semanais'    => 'required|integer|between:1,56',
            'salario'           => 'required|regex:/\d{1,3}(?:\.\d{3})*?,\d{2}/',
        ];
    }

    public function messages(){
        return [
        ];
    }
}
