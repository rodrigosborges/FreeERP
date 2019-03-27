<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoCreate extends FormRequest{

    //retorna aqui quem terá autorização pra usar isso
    public function authorize(){
        return true;
    }

    //regras para validação de cada campo do formulário
    public function rules(){
        return [
            'nome'          => 'required|max:100',
            'prontuario'    => 'required|digits:7|unique:aluno,prontuario',
            'rua'           => 'required|max:100',
            'numero'        => 'required|numeric',
            'bairro'        => 'required|max:100',
        ];
    }

    //modificar as mensagens de erro padrões do laravel
    public function messages(){
        return [
            'prontuario.digits_between' => 'O prontuário deve ter 7 digitos',
        ];
    }
}
