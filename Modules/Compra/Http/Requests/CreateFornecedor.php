<?php
namespace Modules\Compra\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CreateFornecedor extends FormRequest{
    public function rules() {
        return [
            'fornecedor.nome'              => 'required|max:100',
            'endereco.logradouro'           => 'required|max:255',
            'endereco.numero'               => 'required|numeric',
            'endereco.bairro'               => 'required|max:100',
            'endereco.cidade_id'            => 'required',
            'endereco.cep'                  => 'regex:^[0-9]{5}-[0-9]{3}$^',
            'endereco.complemento'          => 'max:255',
            'email'                         => 'required|email|max:100',
        ];
    }

}