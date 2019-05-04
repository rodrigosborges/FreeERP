<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ClienteAssistenciaModel,ConsertoAssistenciaModel,PecaAssistenciaModel,ServicoAssistenciaModel};

class AssistenciaController extends Controller
{
     public function index(){

         return view('assistencia::index');
     }

}
