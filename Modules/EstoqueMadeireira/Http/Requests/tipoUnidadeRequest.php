<?php
namespace Modules\EstoqueMadeireira\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class tipoUnidadeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => ['required', 'min: 3', 'max: 40', 'unique:tipoUnidade,nome,'.$this->route('tipoUnidade')],            
        ];
    }
    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Máximo de :max caracteres!',
            'unique' => 'Nome de Unidade já existente!'
        ];
    }
    public function authorize()
    {
        return true;
    }
}