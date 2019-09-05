<?php

namespace Modules\Usuario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PapelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:3', 'max:50', 'unique:papel']
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
            'min' => 'O campo :attribute deve ter no mínimo 3 caracteres.',
            'max' => 'O campo :attribute pode ter no máximo 50 caracteres.',
            'unique' => 'O campo :attribute já existe.',
        ];
    }
}
