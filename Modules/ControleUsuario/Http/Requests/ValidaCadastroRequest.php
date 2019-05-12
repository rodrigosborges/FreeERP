<?php

namespace Modules\ControleUsuario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaCadastroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *VALIDAÇÃO FRONT-END
     * @return array
     */
    public function rules()
    {
        return [
            
            'name'    => 'required|max:100',
            'email'   => 'required|email|unique:usuario,email',
            'password'=> 'required|min:6'

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

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!',
            'unique' => 'Este email já está cadastrado'
        ];
    }
        
}
