<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Questao;
use Modules\AvaliacaoDesempenho\Entities\Categoria;

class QuestaoController extends Controller
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
            'questoes' => Questao::withTrashed()->get()
        ];

        return view('avaliacaodesempenho::questoes/index', compact('moduleInfo', 'menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'categorias' => Categoria::all()
        ];

        return view('avaliacaodesempenho::questoes/create', compact('moduleInfo', 'menu', 'data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('questao');

            foreach ($input as $key => $value) {

                if (empty($value)) {

                    return back()->with('error', 'Todos os campos são obrigatórios.');
                }
            }

            $questao = Questao::create($input);

            DB::commit();

            return redirect('/avaliacaodesempenho/questao')->with('success', 'Questão Criada com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar a Questão');
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
            'questao' => Questao::findOrFail($id),
            'categorias' => Categoria::all()
        ];

        return view('avaliacaodesempenho::questoes/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $questao = Questao::findOrFail($id);

            $input = $request->input('questao');

            foreach ($input as $key => $value) {
                if (empty($value)) {
                    return back()->with('error', 'Todos os campos são obrigatórios.');
                }
            }

            $questao->update($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/questao')->with('success', 'Questão Atualizada com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar a Questão');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $questao = Questao::withTrashed()->findOrFail($id);

            if($questao->trashed()) {

                $questao->restore();

                DB::commit();
                
                return redirect('/avaliacaodesempenho/questao')->with('success', 'Questao ativada com Sucesso');

            } else {
                
                $questao->delete();
                
                DB::commit();

                return redirect('/avaliacaodesempenho/questao')->with('success', 'Questao desativada com Sucesso');
            }

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';
            print_r($th->getMessage());exit;

            return redirect('/avaliacaodesempenho/questao')->with('error', 'Não foi possivel realizar a operação desejada. Tente novamente mais tarde.');
        }
    }

    public function search(Request $request)
    {

        $term = $request->input('term');

        if (empty($term)) {

            $questoes = Questao::withTrashed()->get();

        } else {

            $questoes = Questao::withTrashed()->where('enunciado', 'LIKE', '%' . $term . '%')
                // ->orWhere('crm', 'LIKE', '%' . $term . '%')
                ->get();
        }

        $table = view('avaliacaodesempenho::questoes/_listar', compact('questoes'))->render();
        return response()->json(['success' => true, 'html' => $table]);
    }
}
