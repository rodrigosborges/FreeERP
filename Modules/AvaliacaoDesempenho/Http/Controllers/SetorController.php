<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Setor;

class SetorController extends Controller
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

        return view('avaliacaodesempenho::setores/index', compact('moduleInfo', 'menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('avaliacaodesempenho::setores/create', compact('moduleInfo', 'menu'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('setor');

            $setor = Setor::create($input);

            DB::commit();

            return redirect('/avaliacaodesempenho/setor')->with('success', 'Setor Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Setor');
        }
    }

    public function show($id)
    {
        return view('avaliacaodesempenho::show', compact('moduleInfo','menu'));
    }

    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'setor' => Setor::findOrFail($id)
        ];

        return view('avaliacaodesempenho::setores/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $setor = Categoria::findOrFail($id);

            $input = $request->input('setor');

            $categoria->update($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/setor')->with('success', 'Setor Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Setor');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $setor = Setor::withTrashed()->findOrFail($id);

            if($setor->trashed()) {

                $setor->restore();

                DB::commit();
                
                return redirect('/avaliacaodesempenho/setor')->with('success', 'Setor ativado com Sucesso');

            } else {
                
                $setor->delete();
                
                DB::commit();

                return redirect('/avaliacaodesempenho/setor')->with('success', 'Setor desativado com Sucesso');
            }

        } catch (\Throwable $th) {
            echo '<pre>';print_r($th->getMessage());exit;
            DB::rollback();

            return redirect('/avaliacaodesempenho/setor')->with('error', 'Não foi possivel realizar a operação desejada. Tente novamente mais tarde.');
        }
    }

    public function search(Request $request)
    {

        $terms = $request->input('term');
        $status = $request->input('status');

        if (empty($terms) && empty($status)) {

            $setores = Setor::withTrashed();

        } else {

            if ($status == '1') {
                $setores = Setor::where('deleted_at', null);
            } else if ($status == '0') {
                $setores = Setor::onlyTrashed();
            } else {
                $setores = Setor::withTrashed();
            }

            foreach ($terms as $key => $term) {
                $setores = $setores->where($key, 'LIKE', '%' . $term . '%');
            }

        }
        $setores = $setores->get();
        
        return view('avaliacaodesempenho::setores._table', compact('setores'));
    }
}
