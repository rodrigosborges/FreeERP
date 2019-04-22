<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AssistenciaController extends Controller
{
     public function index(){
         $moduleInfo = [
             'icon' => 'smartphone',
             'name' => 'Assistência Técnica',
         ];

         $menu = [
             ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
             ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
             ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
             ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
         ];

         return view('assistencia::index',compact('moduleInfo','menu'));
     }

}
