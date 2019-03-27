<?php

namespace Modules\Exemplo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{ExemploModel};

class ExemploController extends Controller{
    public function index(){
        $moduleInfo = [
            'icon' => 'android',
            'name' => 'Exemplo',
        ];

        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
        ];

        return view('exemplo::index',compact('moduleInfo','menu'));
    }

}
