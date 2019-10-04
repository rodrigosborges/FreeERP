<?php

namespace Modules\Cliente\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePedidoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    
    public function rules()
    {
        $rules = [
           
            'numero'                 => ['required','numeric','unique:pedido,numero,'.$this->route('pedido_id')],
            'desconto'               => ['required','numeric','min:0','max:100'],
            'data'                   => ['required', 'date_format:d/m/Y'],
            'produtos.0.produto_id'  => ['required','numeric','exists:produto,id'],
            'produtos.0.quantidade'  => ['required', 'numeric','min:1'],
            'produtos.0.desconto'    => ['required','numeric','min:0','max:100'],
            'produtos.*.produto_id'  => ['required','numeric','exists:produto,id'],
            'produtos.*.quantidade'  => ['required','numeric','min:1'],
            'produtos.*.desconto'    => ['required','numeric','min:0','max:100'],

        ];
        
        return $rules;
    }
    public function messages()
    {
        return [
            'required'              => 'Esse campo é obrigatório.',
            'numeric'               => 'Esse campo deve conter apenas números.',
            'unique'                => 'Esse campo deve conter um valor único.',
            'exists'                => 'Esse campo deve conter um valor válido.',
            'date_format'           => 'Esse campo deve conter um formato de data valido',
            'min'                   => 'O valor inserido é inferior ao valor minimo',
            'max'                   => 'O valor inserido é superior ao valor maximo'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
}