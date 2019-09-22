<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Http\Requests\StoreProcesso;

class ProcessoController extends Controller
{

    protected $moduleInfo;

    protected $menu;

    public function __construct()
    {
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

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo', 'menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'funcionarios' => Funcionario::all(),
        ];

        return view('avaliacaodesempenho::processos/create', compact('moduleInfo', 'menu', 'data'));
    }

    public function store(StoreProcesso $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input();
            echo '<pre>';print_r($input);exit;

            $processo = Processo::create($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/processos')->with('success', 'Processo Criado com Sucesso');

        } catch (\Throwable $th) {
            // echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Processo');
        }
    }

    public function show($id)
    {
        return view('avaliacaodesempenho::show');
    }

    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'processo' => Processo::findOrFail($id),
            'funcionarios' => Funcionario::all()
        ];

        return view('avaliacaodesempenho::processos/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(Request $request, $id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        // Logica de inserçao
        $teste = $request->input();
        echo '<pre>';
        print_r($teste);exit;

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo', 'menu'));
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {

        $term = $request->input('term');

        if (empty($term)) {

            $processos = Processo::all();

        } else {

            $processos = Processo::withTrashed()->where('nome', 'LIKE', '%' . $term . '%')
                ->orWhere('crm', 'LIKE', '%' . $term . '%')
                ->get();
        }

        $table = view('avaliacaodesempenho::processos/_table', compact('processos'))->render();
        return response()->json(['success' => true, 'html' => $table]);
    }
}
