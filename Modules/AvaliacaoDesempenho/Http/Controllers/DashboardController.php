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
            'icon' => 'work',
            'name' => 'Avaliacao Desempenho',
        ];

        $this->menu = [
            ['icon' => 'dashboard', 'tool' => 'DashBoard', 'route' => '/tcc/public/avaliacaodesempenho'],
            ['icon' => 'folder', 'tool' => 'Processos', 'route' => '/tcc/public/avaliacaodesempenho/processo'],
            ['icon' => 'library_books', 'tool' => 'Avaliações', 'route' => '/tcc/public/avaliacaodesempenho/avaliacao'],
            ['icon' => 'format_list_numbered', 'tool' => 'Questões', 'route' => '/tcc/public/avaliacaodesempenho/questao'],
            ['icon' => 'storefront', 'tool' => 'Setor', 'route' => '/tcc/public/avaliacaodesempenho/setor'],
            ['icon' => 'format_list_bulleted', 'tool' => 'Categorias', 'route' => '/tcc/public/avaliacaodesempenho/categoria'],
            ['icon' => 'assessment', 'tool' => 'Relatorios', 'route' => '/tcc/public/avaliacaodesempenho/relatorio'],
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
