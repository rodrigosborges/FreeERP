<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;

class ProgramacaoController extends Controller
{
    public function exibir($id){
        $evento = Evento::find($id);
        return view('eventos::programacao', ['evento' => $evento]);
    }
}
