<?php

namespace Modules\Recrutamento\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:100',
            'categoria_id' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!'
        ];
    }
}
