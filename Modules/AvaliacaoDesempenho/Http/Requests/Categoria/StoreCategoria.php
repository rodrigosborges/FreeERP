<?php

namespace Modules\AvaliacaoDesempenho\Http\Requests\Categoria;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoria extends FormRequest {

    public function rules() {
        
        return [
            'categoria.nome' => 'required'
        ];
    }

    public function messages() {

        return [
            'required' => 'Este campo é obrigatorio.'
        ];
    }
}