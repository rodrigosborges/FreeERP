<?php

namespace Modules\Calendario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaSalvarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agendaNome' => 'required | string | max:100',
            'agendaDescricao' => 'max:500 | string | nullable',
            'agendaCor' => 'required | numeric'
        ];
    }

    public function attributes()
    {
        return [
            'agendaNome' => 'título',
            'agendaDescricao' => 'descrição',
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
}
