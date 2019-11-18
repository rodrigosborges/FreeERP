<?php
namespace Modules\EstoqueMadeireira\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class ClienteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required |min: 3| max: 40',
            // 'cnpj' => 'required |cnpj| unique:cliente,cnpj,'.$this->route('id'),
            'cpf' => 'required |cpf| unique:cliente.,documento,',$this->route('id'),
            'telefone' => 'required |telefone| min:9',
            
        ];
    }
    public function messages(){
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'unique' => 'Já existente!',
            'min' => 'Minimo de :min caracteres!',
            'max' => 'Máximo de :max caracteres!',
            'cnpj' => 'CNPJ Inválido!',
            'cpf' => 'CPF Inválido!',
            'telefone' => 'Telefone Inválido!'
        ];
    }
    public function authorize()
    {
        return true;
    }
}