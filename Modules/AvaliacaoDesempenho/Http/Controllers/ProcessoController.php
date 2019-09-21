<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProcessoController extends Controller
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

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo','menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('avaliacaodesempenho::processos/create', compact('moduleInfo','menu'));
    }

    public function store(Request $request)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        // Logica de inserçao
        $teste = $request->input();
        echo '<pre>';print_r($teste);exit;

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo','menu'));
    }

    public function show($id)
    {
        return view('avaliacaodesempenho::show');
    }

    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data['processo'] = (object)[
            'id' => $id
        ];

        return view('avaliacaodesempenho::processos/edit', compact('moduleInfo','menu', 'data'));
    }

    public function update(Request $request, $id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        // Logica de inserçao
        $teste = $request->input();
        echo '<pre>';print_r($teste);exit;

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo','menu'));
    }

    public function destroy($id)
    {
        //
    }
}
