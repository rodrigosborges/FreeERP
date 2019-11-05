<?php

namespace Modules\Eventos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvaEvento extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:2',
            'local' => 'required',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after_or_equal:dataInicio',
            'descricao' => 'required',
            'imgEvento' => 'nullable|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'empresa' => 'required',
            'email' => 'nullable|email',
            'telefone' => 'nullable|min:10|max:14',
            'cidade' => 'required',
        ];
    }
    
    public function messages() 
    {   
        return [     
            'required' => 'O campo :attribute é obrigatório',     
            'telefone.min' => 'O campo :attribute deve ter no mínimo 10 caracteres',
            'imgEvento.max' => 'O campo :imagem não pode receber imagens maiores de 2MB'
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
