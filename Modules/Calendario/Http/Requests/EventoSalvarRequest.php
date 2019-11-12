<?php

namespace Modules\Calendario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Calendario\Http\Controllers\EventoController;

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
            'eventoNotificacaoTempo' => 'integer | max:999 | min:1',
            'eventoNotificacaoPeriodo' => 'integer | max:86400 | min:59 |required_if:eventoNotificacaoTempo, != , null',
            'eventoDiaTodo' => 'boolean',
            'eventoNota' => 'string | max:500 | nullable',
            'eventoConvite' => 'array'
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            $data_inicial = EventoController::formatar_data($this->eventoDataInicio);
            $data_final = EventoController::formatar_data($this->eventoDataFim);
            if($data_inicial->greaterThan($data_final))
                $validator->errors()->add('eventoDataFim', 'A data final não pode ser anterior a data inicial');
        });
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
