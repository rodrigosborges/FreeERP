<?php

namespace Modules\Estoque\Http\Requests;

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
            'nome' => ['required', 'min: 3', 'max: 45', 'unique:categoria,nome,'.$this->route('categoria')],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O Campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve conter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve conter no mínimo :max caracteres',
            'unique'=>'Esta categoria já está cadastrada'
            
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
