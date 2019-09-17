<?php

namespace Modules\Cliente\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePedidoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function messages()
    {
        return [
            'cliente_id'             => 'Cliente invalido',
            'numero'                 => 'Informe um numero válido para o pedido',
            'desconto'               => 'Desconto deve ser entre 0 e 100',
            'data'                   => 'Uma data deve ser informada',

            'produtos.*.produto_id'  => 'Informe um id válido para o produto',
            'produtos.*.quantidade'  => 'Informe uma quantidade válida para o produto',
            'produtos.*.desconto'    => 'Desconto deve ser entre 0 e 100',            
        ];
    }
    public function rules()
    {
        $rules = [
            // $table->integer('id', true);	// $table->integer('cliente_id')->index('fk_pedido_cliente1');
			// $table->integer('numero');	// $table->float('desconto', 10, 0)->nullable();
            // $table->date('data'); // $table->timestamps(); 	// $table->softDeletes(); 
            
            'cliente_id'             => ['required','exists:cliente,id'],
            'numero'                 => ['required','numeric'],
            'desconto'               => ['required','numeric','min:0','max:100'],
            'data'                   => ['required','date'],

            'produtos.0.produto_id'  => ['required','numeric','exists:produto,id'],
            'produtos.0.quantidade'  => ['required', 'numeric','min:1'],
            'produtos.0.desconto'    => ['required','numeric','min:0','max:100'],

            'produtos.*.produto_id'  => ['required','numeric','exists:produto,id'],
            'produtos.*.quantidade'  => ['required','numeric','min:1'],
            'produtos.*.desconto'    => ['required','numeric','min:0','max:100'],


        ];
        
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * 
     */
    public function authorize()
    {
        return true;
    }
}
