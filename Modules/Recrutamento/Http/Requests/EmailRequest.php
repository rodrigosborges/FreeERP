<?php

namespace Modules\Recrutamento\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!'
        ];
    }
}
