<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;

class DashboardController extends Controller
{
    
    protected $moduleInfo;

    protected $menu;
  
    public function __construct() {

        $this->middleware('auth');

        $this->moduleInfo = [
            'icon' => 'android',
            'name' => 'Avaliacao Desempenho',
        ];

        $this->menu = [
            ['icon' => 'add_box', 'tool' => 'DashBoard', 'route' => '/tcc/public/avaliacaodesempenho'],
            ['icon' => 'add_box', 'tool' => 'Processos', 'route' => '/tcc/public/avaliacaodesempenho/processo'],
            ['icon' => 'add_box', 'tool' => 'Avaliações', 'route' => '/tcc/public/avaliacaodesempenho/avaliacao'],
            ['icon' => 'add_box', 'tool' => 'Questões', 'route' => '/tcc/public/avaliacaodesempenho/questao'],
            ['icon' => 'add_box', 'tool' => 'Setor', 'route' => '/tcc/public/avaliacaodesempenho/setor'],
            ['icon' => 'add_box', 'tool' => 'Categorias', 'route' => '/tcc/public/avaliacaodesempenho/categoria'],
            ['icon' => 'add_box', 'tool' => 'Relatorios', 'route' => '/tcc/public/avaliacaodesempenho/relatorio'],
        ];
    }

    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'processos' => Processo::all(),
            'avaliacoes' => Avaliacao::all(),
            'funcionarios' => Funcionario::all(),
            'processos_abertos' => Processo::where('status_id', '!=', 3)->where('status_id', '!=', 4)->get(),
            'processos_atrasados' => Processo::where('status_id', 4)->get(),
            'avaliacoes_abertas' => Avaliacao::where('status_id', '!=', 3)->where('status_id', '!=', 4)->get(),
            'avaliacoes_atrasadas' => Avaliacao::where('status_id', 4)->get(),
            'processo_ultimo' => Processo::where('status_id', 3)->orderBy('created_at', 'desc')->limit(1)->get()
        ];
        
        return view('avaliacaodesempenho::dashboard/index', compact('moduleInfo', 'menu', 'data'));
    }
}
