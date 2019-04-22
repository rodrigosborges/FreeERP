<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index()
     {
       $moduleInfo = [
           'icon' => 'android',
           'name' => 'Assistência Técnica',
       ];

       $menu = [
           ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
           ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
           ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
           ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
       ];

       return view('assistencia::paginas.estoque',compact('moduleInfo','menu'));
     }



}
