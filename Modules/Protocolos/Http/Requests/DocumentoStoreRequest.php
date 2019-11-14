<?php

namespace Modules\Protocolos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'documento' => ['required']
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
        ];
    }
}
