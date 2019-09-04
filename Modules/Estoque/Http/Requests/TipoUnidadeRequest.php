<?php

namespace Modules\Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoUnidadeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min: 3', 'max: 45'],
            'quantidade_itens' => ['required'],

        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Máximo de :max caracteres!',

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
