<?php

namespace Modules\Recrutamento\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'cargo_id' => 'required',
            // 'salario' => 'required',
            // 'escolaridade' => 'required',
            // 'status' => 'required',
            // 'regime' => 'required',
            // 'beneficios' => 'required',
            // 'descricao' => 'required',
            // 'especificacoes' => 'required',
        ];
    }

    public function messages() {
        return [
            // 'required' => 'Este campo é obrigatório!'
        ];
    }
}
