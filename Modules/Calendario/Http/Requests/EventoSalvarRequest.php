<?php

namespace Modules\Calendario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoSalvarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'eventoTitulo' => 'required',
            'eventoDataInicio' => 'required',
            'eventoDataFim' => 'required',
            'eventoNotificacaoTempo' => '',
            'eventoNotificacaoPeriodo' => '',
            'eventoDiaTodo' => '',
            'eventoNota' => ''
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
