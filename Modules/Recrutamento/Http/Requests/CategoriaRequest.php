<?php

namespace Modules\Recrutamento\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
        ];
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!'
        ];
    }
}
