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
            'eventoTitulo' => 'required | string | max:100',
            'eventoDataInicio' => 'required',
            'eventoDataFim' => 'required',
            'eventoNotificacaoTempo' => 'integer | max:999',
            'eventoNotificacaoPeriodo' => 'integer | max:86400',
            'eventoDiaTodo' => 'boolean',
            'eventoNota' => 'max:500',
            'eventoConvite' => 'array'
        ];
    }

    public function attributes()
    {
        return [
            'eventoDataInicio' => 'data inicial',
            'eventoDataFim' => 'data final',
            'eventoNotificacaoTempo' => 'tempo',
            'eventoNotificacaoPeriodo' => 'período',
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
