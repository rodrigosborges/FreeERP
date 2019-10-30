<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Categoria;
use Modules\AvaliacaoDesempenho\Http\Requests\Categoria\StoreCategoria;
use Modules\AvaliacaoDesempenho\Http\Requests\Categoria\UpdateCategoria;

class CategoriaController extends Controller
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

        return view('avaliacaodesempenho::categorias/index', compact('moduleInfo', 'menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('avaliacaodesempenho::categorias/create', compact('moduleInfo', 'menu'));
    }

    public function store(StoreCategoria $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('categoria');

            $categoria = Categoria::create($input);

            DB::commit();

            return redirect('/avaliacaodesempenho/categoria')->with('success', 'Categoria Criado com Sucesso');

        } catch (\Throwable $th) {

            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar a Categoria');
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
            'categoria' => Categoria::findOrFail($id)
        ];

        return view('avaliacaodesempenho::categorias/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(UpdateCategoria $request, $id)
    {
        DB::beginTransaction();

        try {
            $categoria = Categoria::findOrFail($id);

            $input = $request->input('categoria');

            $categoria->update($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/categoria')->with('success', 'Categoria Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar a Categoria');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $categoria = Categoria::withTrashed()->findOrFail($id);

            if($categoria->trashed()) {

                $categoria->restore();

                DB::commit();
                
                return redirect('/avaliacaodesempenho/categoria')->with('success', 'Categoria ativada com Sucesso');

            } else {
                
                $categoria->delete();
                
                DB::commit();

                return redirect('/avaliacaodesempenho/categoria')->with('success', 'Categoria desativada com Sucesso');
            }

        } catch (\Throwable $th) {
            echo '<pre>';print_r($th->getMessage());exit;
            DB::rollback();

            return redirect('/avaliacaodesempenho/categoria')->with('error', 'Não foi possivel realizar a operação desejada. Tente novamente mais tarde.');
        }
    }

    public function search(Request $request)
    {

        $terms = $request->input('term');
        $status = $request->input('status');

        if (empty($terms) && empty($status)) {

            $categorias = Categoria::withTrashed();

        } else {

            if ($status == '1') {
                $categorias = Categoria::where('deleted_at', null);
            } else if ($status == '0') {
                $categorias = Categoria::onlyTrashed();
            } else {
                $categorias = Categoria::withTrashed();
            }

            foreach ($terms as $key => $term) {
                $categorias = $categorias->where($key, 'LIKE', '%' . $term . '%');
            }

        }
        $categorias = $categorias->get();
        
        $table = view('avaliacaodesempenho::categorias/_table', compact('categorias'))->render();
        return response()->json(['success' => true, 'html' => $table]);
    }
}
