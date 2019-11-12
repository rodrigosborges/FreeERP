<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Log};

class LogController extends Controller{
    public function index(Request $request){
        return view('funcionario::logs.index');
    }

    public function list(Request $request){
        $logs = new Log;

        if($request->mensagem){
            $logs = $logs->where('mensagem', 'LIKE', "%$request->mensagem%");
        }

        if($request->de){
            $de = \DateTime::createFromFormat('d/m/Y', $request->de);
            if($de !== false && checkdate($de->format('m'), $de->format('d'), $de->format('Y')))
                $logs = $logs->where('created_at', '>=', $de->format('Y-m-d'));
        }

        if($request->ate){
            $ate = \DateTime::createFromFormat('d/m/Y', $request->ate);
            if($ate !== false && checkdate($ate->format('m'), $ate->format('d'), $ate->format('Y')))
                $logs = $logs->where('created_at', '<=', $ate->format('Y-m-d')." 23:59:59");
        }

        $logs = $logs->paginate(10);
        return view('funcionario::logs.table', compact("logs"));
    }
}