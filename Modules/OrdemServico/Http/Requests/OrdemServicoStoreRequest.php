<?php

namespace Modules\OrdemServico\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdemServicoStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "solicitante.id" => 'required|max:14',
            "solicitante.nome" => 'required',
            "solicitante.email" => 'required|email|unique:solicitante,email',
            "endereco.cep" => 'max:9',
            "endereco.rua" => 'required',
            "endereco.bairro" => 'required',
            "endereco.numero" => 'required',
            "telefone" => 'required|max:9',
            "aparelho.numero_serie" => 'required',
            "aparelho.marca" => 'required',
            "aparelho.modelo" => 'required',
            "aparelho.tipo_aparelho" => 'required',
            "problema.titulo" => 'required',
            "descricao" => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return[
            "solicitante.id" => 'Identificação',
            "solicitante.nome" => 'Nome',
            "solicitante.email" => 'Email',
            "endereco.rua" => 'Rua',
            "endereco.bairro" => 'Bairro',
            "endereco.numero" => 'Numero',
            "telefone" => 'Telefone',
            "aparelho.numero_serie" => 'Número de Série',
            "aparelho.marca" => 'Marca',
            "aparelho.modelo" => 'Modelo',
            "aparelho.tipo_aparelho" => 'Tipo de Aparelho',
            "problema.titulo" => 'Problema',
            "descricao" => 'Descricao'
   
    ];
    }
    public function messages()
    {
        return [
            'required' => "O campo :attribute é Obrigátorio"
        ];
    }
}
