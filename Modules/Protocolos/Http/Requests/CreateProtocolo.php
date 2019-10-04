<?php

namespace Modules\Protocolos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProtocolo extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'protocolo.interessado'                     => 'required',
            'protocolo.tipo_protocolo_id'               => 'required',
            'protocolo.assunto'                         => 'required|max:100',
            'protocolo.nivel_acesso_id'                 => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages() {
        return [
            'required' => 'Este campo é obrigatório!',
        ];
    }
}
