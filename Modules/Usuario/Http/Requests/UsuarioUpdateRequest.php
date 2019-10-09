<?php

namespace Modules\Usuario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apelido' => ['required', 'min:3', 'max:50','unique:usuario,apelido,'.$this->route('id')],
            'email' => ['required', 'email', 'unique:usuario,email,'.$this->route('id')],
            'avatar' => ['mimes:jpeg,png'],
            'papel' => ['required'],
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
        ];
    }

    public function attributes() {
        return [
            'password' => 'senha',
            'repeat_password' => "confirmar a senha",
        ];
    }
}
