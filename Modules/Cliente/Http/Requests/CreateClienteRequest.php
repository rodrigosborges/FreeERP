<?php

namespace Modules\Cliente\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateClienteRequest extends FormRequest
{
    
    public function rules()
    {

        
        $rules =  [
            'cliente.nome'                  => ['required','max:100'],
            'cliente.tipo_cliente_id'       => ['required','exists:tipo_cliente,id'],
            'telefones.*.numero'            => ['required','telefone'],
            'telefones.*.tipo_telefone_id'  => ['required','exists:tipo_telefone,id'],
            'documento.documento'           => ['required','docunico:'.$this->route('cliente')], 
            'email.email'                   => ['required','email','max:100'],
            'endereco.logradouro'           => ['required'],
            'endereco.bairro'               => ['required'],
            'endereco.numero'               => ['required'],
            'endereco.cidade_id'            => ['required'],
            'endereco.cep'                  => ['regex:^[0-9]{5}-[0-9]{3}$^']          
        ];
        
        if($this->input('cliente.tipo_cliente_id') == 1) {
            $rules['documento.documento'][] = 'cpf';
        } else if ($this->input('cliente.tipo_cliente_id') == 2) {
            $rules['documento.documento'][] = 'cnpj';
            $rules['cliente.nome_fantasia'] = 'required|max:100';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'required'              => 'Esse campo é obrigatório.',
            'numeric'               => 'Esse campo deve conter apenas números.',
            'unique'                => 'Esse campo deve conter um valor único.',
            'exists'                => 'Esse campo deve conter um valor válido.',
            'email'                 => 'Esse campo deve conter um e-mail válido',
            'regex'                 => 'Esse campo deve conter um formato válido',
            'max'                   => 'O valor inserido é superior ao valor maximo'
        ];
    }
        
    
    public function authorize()
    {
        return true;
    }
}
