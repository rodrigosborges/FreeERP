<?php

namespace Modules\Funcionario\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateFuncionario extends FormRequest{

    public function rules() {
        return [
            'funcionario.nome'                  => 'required|max:100',
            'funcionario.data_nascimento'       => 'required|date_format:"d/m/Y"',
            'funcionario.sexo'                  => 'required',
            'funcionario.estado_civil_id'       => 'required',
            'funcionario.data_admissao'         => 'required|date_format:d/m/Y',
            'documentos.cpf.numero'             => 'required|cpf|cpfUnico:'.$this->route('funcionario'),
            'documentos.rg.numero'              => 'required',
            'docs_outros.*.tipo_documento_id'   => 'required_with:docs_outros.0.tipo_documento_id',
            'docs_outros.*.numero'              => 'required_with:docs_outros.0.numero',
            'endereco.logradouro'               => 'required|max:255',
            'endereco.numero'                   => 'required|numeric',
            'endereco.bairro'                   => 'required|max:100',
            'endereco.cidade_id'                => 'required',
            'endereco.cep'                      => 'regex:^[0-9]{5}-[0-9]{3}$^',
            'endereco.complemento'              => 'max:255',
            'email'                             => 'required|email|max:100',
            'telefones.*.tipo_telefone_id'      => 'required',
            'telefones.*.numero'                => 'required|telefone',
            'dependentes.*.parentesco_id'       => 'required_with:dependentes.0.parentesco_id',
            'dependentes.*.mora_junto'          => 'required_with:dependentes.0.mora_junto',
            'dependentes.*.nome'                => 'required_with:dependentes.0.nome',
            'dependentes.*.cpf'                 => 'required_with:dependentes.0.cpf|cpf'
        ];
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!',
            'cpf'      => 'Este CPF é inválido!',
            'telefone' => 'Este número de telefone é inválido!',
            'cpf_unico' => 'Este CPF já está sendo utilizado!',
        ];
    }
}