<?php

namespace Modules\Funcionario\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateFuncionario extends FormRequest{

    public function rules() {
        return [
            'funcionario.nome'              => 'required|max:100',
            'funcionario.data_nascimento'   => 'required|date_format:"d/m/Y"',
            'funcionario.sexo'              => 'required',
            'funcionario.estado_civil_id'   => 'required',
            'funcionario.data_admissao'     => 'required|date_format:d/m/Y',
            'documentos.cpf.numero'         => 'required|cpf',
            'documentos.rg.numero'          => 'required',
            'docs_outros.*'                 => 'required',
            'endereco.logradouro'           => 'required|max:255',
            'endereco.numero'               => 'required|numeric',
            'endereco.bairro'               => 'required|max:100',
            'endereco.cidade_id'            => 'required',
            'endereco.cep'                  => 'regex:^[0-9]{5}-[0-9]{3}$^',
            'endereco.complemento'          => 'max:255',
            'email'                         => 'required|email|max:100',
        ];
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!',
            'cpf'      => 'CPF inválido!'
        ];
    }
}