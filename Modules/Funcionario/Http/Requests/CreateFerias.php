<?php

namespace Modules\Funcionario\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateFerias extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data_inicio'     => 'required|date',
            'data_fim'        => 'required|date',
            'dias_ferias'     => 'required|numeric|max:30',
            'data_pagamento'  => 'required|date',
            'data_aviso'      => 'required|date',
            'observacao'      => 'nullable',
            'data_pagamento'  => 'required|date|before:data_inicio',
            'data_aviso'      => 'required|date|before:data_inicio'
        ];
    }
}
