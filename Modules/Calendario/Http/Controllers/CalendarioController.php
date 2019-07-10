<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;

class CalendarioController extends Controller
{
    public function index()
    {
        //TODO Get agendas do funcinário logado
        $agendas = Agenda::where('funcionario_id', 1)->get();
        return view('calendario::index', ['agendas' => $agendas]);
    }
}
