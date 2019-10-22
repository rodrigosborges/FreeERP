<?php

namespace Modules\Funcionario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateDemissao extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request::input('aviso_previo_indenizado') == 'on'){
            return [
                'data_demissao'         => 'required|date',
                'data_pagamento'        => 'required|date|after:data_demissao',
                'data_inicio_aviso'     => 'required|date|before:data_demissao',
                'dias_aviso_indenizado' => 'required|integer',
                'tipo_demissao'         => 'required|numeric|max:9'
            ];

        } else {
            return [
                'data_demissao'         => 'required|date',
                'data_pagamento'        => 'required|date|after:data_demissao',
                'tipo_demissao'         => 'required',
                'data_inicio_aviso'     => 'nullable',
                'dias_aviso_indenizado' => 'nullable',
                'tipo_reducao_aviso'    => 'nullable',
                'aviso_previo_indicador_cumprimento_id' => 'nullable',
                'tipo_demissao'         => 'required|numeric|max:9'
            ];
        } 
        
    }

    public function messages() {
        return [
            'max' => 'O campo :attribute  não está com tipo selecionado.'
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

//'cpf' => ($request['tipo']=='F' ? 'required|cpf' : 'nullable')