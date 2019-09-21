<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    
    protected $moduleInfo;

    protected $menu;
  
    public function __construct() {
        $this->moduleInfo = [
            'icon' => 'android',
            'name' => 'Avaliacao Desempenho',
        ];

        $this->menu = [
            ['icon' => 'add_box', 'tool' => 'DashBoard', 'route' => '/tcc/public/avaliacaodesempenho'],
            ['icon' => 'add_box', 'tool' => 'Processos', 'route' => '/tcc/public/avaliacaodesempenho/processos'],
            ['icon' => 'add_box', 'tool' => 'Avaliações', 'route' => '/tcc/public/avaliacaodesempenho/avaliacoes'],
            ['icon' => 'add_box', 'tool' => 'Questões', 'route' => '/tcc/public/avaliacaodesempenho/questoes'],
            ['icon' => 'add_box', 'tool' => 'Categorias', 'route' => '/tcc/public/avaliacaodesempenho/categorias'],
            ['icon' => 'add_box', 'tool' => 'Relatorios', 'route' => '/tcc/public/avaliacaodesempenho/relatorios'],
        ];
    }

    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('avaliacaodesempenho::dashboard/index', compact('moduleInfo','menu'));
    }

    public function create()
    {
        return view('avaliacaodesempenho::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('avaliacaodesempenho::show');
    }

    public function edit($id)
    {
        return view('avaliacaodesempenho::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
