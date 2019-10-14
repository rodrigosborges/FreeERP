<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDemissao extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data_demissao'         => 'required|date',
            'data_pagamento'        => 'required|date|after:data_demissao',
            'data_inicio_aviso'     => 'date|before:data_demissao',
            'dias_aviso_indenizado' => 'numeric|integer'
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
}

//'cpf'               => ($request['tipo']=='F' ? 'required|cpf' : 'nullable')