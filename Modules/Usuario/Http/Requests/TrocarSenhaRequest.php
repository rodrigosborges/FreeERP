<?php

namespace Modules\Usuario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Usuario\Rules\VerificarSenha;

class TrocarSenhaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required', 'max:16', 'same:repeat_password', new VerificarSenha],
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
            'required' => 'O campo :attribute é obrigatório!',
            'password.same' => 'O campo senha deve corresponder ao campo confirmar senha.',
        ];
    }

    public function attributes() {
        return [
            'password' => 'senha',
            'repeat_password' => "confirmar a senha",
        ];
    }
}
