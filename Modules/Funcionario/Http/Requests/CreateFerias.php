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
            'data_inicio' => 'required|date|after:fim_periodo_aquisitivo'
        ];
    }
}
