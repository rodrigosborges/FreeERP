<?php

namespace Modules\Protocolos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProtocoloStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assunto' => ['required', 'min:20', 'max:500'],
            'protocolo.tipo_protocolo_id'   => ['required'],
            'protocolo.tipo_acesso' => ['required'],
            'interessados' => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    public function messages() {
        return [
            'required'  => 'O campo é obrigatório!',
            'min'       => 'Digite no mínimo 50 caracteres.',
            'max'       => 'Digite no máximo 500 caracteres.',
        ];
    }
}
