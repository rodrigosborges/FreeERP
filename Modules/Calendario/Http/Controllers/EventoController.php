<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Evento;

class EventoController extends Controller
{
    public function salvar(Request $request){
        try{
            $evento = new Evento();
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $request->eventoDataInicio;
            $evento->data_fim = $request->eventoDataFim;
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $evento->agenda_id = $request->eventoAgenda;
            $evento->save();
        }catch (QueryException $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar evento. Erro: ' . $e->getMessage());
        }
        return redirect()->route('calendario.index')->with('success', 'Evento criado com sucesso.');
    }
}
