<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ClienteAssistenciaModel,PagamentoAssistenciaModel,ConsertoAssistenciaModel,PecaAssistenciaModel,ServicoAssistenciaModel};

class AssistenciaController extends Controller
{
     public function index(){
        $pago = PagamentoAssistenciaModel::where('status','pago')->count();
        $pendente = PagamentoAssistenciaModel::where('status','pendente')->count();
        $finalizados = ConsertoAssistenciaModel::where('situacao','Aguardando retirada do cliente')->paginate(4);


        return view('assistencia::index',compact('pago', 'pendente','finalizados'));
        
     }

}
