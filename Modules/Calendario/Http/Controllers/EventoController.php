<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Evento;

class EventoController extends Controller
{
    public function salvar(Request $request){
        try{
            $evento = new Evento();
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = Carbon::createFromFormat('d/m/Y H:i', $request->eventoDataInicio);
            $evento->data_fim = Carbon::createFromFormat('d/m/Y H:i', $request->eventoDataFim);
            $evento->notificacao = $evento->data_inicio->subSeconds($request->eventoNotificacaoTempo * $request->eventoNotificacaoPeriodo);
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $evento->agenda_id = $request->eventoAgenda;
            $evento->save();
        }catch (\Exception $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar evento. Erro: ' . $e->getCode());
        }
        return redirect()->route('calendario.index')->with('success', 'Evento criado com sucesso.');
    }
}
