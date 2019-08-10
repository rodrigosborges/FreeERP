<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;

class CalendarioController extends Controller
{
    public function index()
    {
        //TODO Get agendas do funcinário logado
        $agendas = Agenda::where('funcionario_id', 1)->orderBy('titulo')->get();
        return view('calendario::index', ['agendas' => $agendas]);
    }

    public function agendas(){
        $agendas = Agenda::where('funcionario_id', 1)->get();
        return view('calendario::agendas.index', ['agendas' => $agendas]);
    }

    public function eventos()
    {
        $eventos = [];
        $agendas = Agenda::where('funcionario_id', 1)->get();
        foreach ($agendas as $agenda) {
            $eventos = array_merge($eventos, $agenda->eventos_json);
        }
        return $eventos;
    }
}
