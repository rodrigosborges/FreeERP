<?php

namespace Modules\OrdemServico\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            "titulo" => 'required|unique:status,titulo'
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

    public function messages()
    {
        return [
            'required' => "O campo :attribute é obrigátorio",
            'unique' => "Titulo Já cadastrado"
        ];
    }
}
