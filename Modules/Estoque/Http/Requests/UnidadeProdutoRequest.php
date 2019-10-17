<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeProdutoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => ['required', 'min: 1', 'max: 45']
        ];
    }


    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'O campo não pode ser vazio',
            'max' => 'Você excedeu o número de caracteres! (45)',
            'unique' => ':attribute já cadastrado!'
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
}
