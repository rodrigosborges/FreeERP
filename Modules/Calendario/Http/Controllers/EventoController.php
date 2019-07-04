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
            //$evento->save();
            dd($evento);

        }catch (QueryException $e){
            dd($e);
        }
    }
}
