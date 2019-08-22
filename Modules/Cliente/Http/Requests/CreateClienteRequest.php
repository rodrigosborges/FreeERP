<?php

namespace Modules\Cliente\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClienteRequest extends FormRequest
{
    
    public function rules()
    {
        
        $rules =  [
            'nome'                          => ['required','max:100'],
            'tipo_cliente_id'               => ['required','exists:tipo_cliente,id'],
            'telefones.*.numero'            => ['required','telefone'],
            'telefones.*.tipo_telefone_id'  => ['required','exists:tipo_telefone,id'],
            'documento'                     => ['required'],
            'email'                         => ['required','email','max:100'],
            'endereco.logradouro'           => ['required'],
            'endereco.bairro'               => ['required'],
            'endereco.numero'               => ['required'],
            'endereco.cidade_id'            => ['required'],
            'endereco.cep'                  => ['regex:^[0-9]{5}-[0-9]{3}$^']          
        ];
        
        if($this->input('tipo_cliente_id') == 1){
            $rules['documento'][] = 'cpf';
        }
        return $rules;
    }

    
    public function authorize()
    {
        return true;
    }
}
