<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\Modulo;

class InicioController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */



    public function listarModulos(Request $request)
    {   
        $modulosAtivos = Modulo::all();
        $modulosInativos = Modulo::onlyTrashed()->get();


        return view('usuario::home', compact(
            'modulosAtivos',
            'modulosInativos'
        ));
        

    }
}