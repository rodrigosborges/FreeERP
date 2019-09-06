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
        
        if($this->input('cliente.tipo_cliente_id') == 1){
            $rules['documento.documento'][] = 'cpf';
        } else if ($this->input('cliente.tipo_cliente_id') == 2){
            $rules['documento.documento'][] = 'cnpj';
            $rules['cliente.nome_fantasia'] = 'required|max:100';
        }
        return $rules;
    }
    // public function messages() {
    //     return [
    //         'cliente.nome'                  => 'Digite o nome do cliente.',
    //         'cliente.tipo_cliente_id'       => 'Informe o tipo de cliente.',
    //         'telefones.*.numero'            => 'Informe o numero do telefone.',
    //         'telefones.*.tipo_telefone_id'  => 'Informe o tipo de telefone.',
    //         'documento.documento'           => 'Informe o documento.',
    //         'email.email'                   => 'Informe o email do cliente.',
    //         'endereco.logradouro'           => 'Informe a rua/avenida.',
    //         'endereco.bairro'               => 'Informe o bairro.',
    //         'endereco.numero'               => 'Informe o numero da casa.',
    //         'endereco.cidade_id'            => 'Informe a cidade.',
    //         'endereco.cep'                  => 'Informe o cep.',
    //     ];
    // }
        
    
    public function authorize()
    {
        return true;
    }
}
