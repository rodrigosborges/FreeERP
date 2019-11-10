<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\ResultadoGestor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario;

class RelatorioController extends Controller
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
            ['icon' => 'add_box', 'tool' => 'Relatorios Individuais', 'route' => '/tcc/public/avaliacaodesempenho/relatorio'],
        ];
    }

    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'processos' => Processo::where('status_id', '!=', 1)->get()
        ];

        return view('avaliacaodesempenho::relatorios/individual/index', compact('moduleInfo', 'menu', 'data'));
    }

    public function show($id)
    {
        return view('avaliacaodesempenho::show');
    }

    public function individual(Request $request) 
    {
        $id = $request->input('avaliacao');

        $avaliacao = Avaliacao::findOrFail($id);

        if ($avaliacao->tipo->id == 1) {
            $resultados = ResultadoFuncionario::where('avaliacao_id', $avaliacao->id)->with('avaliacao', 'avaliador', 'avaliado');
        } else {
            $resultados = ResultadoGestor::where('avaliacao_id', $avaliacao->id)->with('avaliacao', 'avaliador', 'avaliaod');
        }

        $result = $resultados->get();

        return $result;

        return view('avaliacaodesempenho::relatorios/individual/_table', compact('result'));
        
    }

    public function getAvaliacoes(Request $request) 
    {
        $id = $request->input('id');

        $processo = Processo::findOrFail($id);

        return $processo->avaliacoes;
    }
}
