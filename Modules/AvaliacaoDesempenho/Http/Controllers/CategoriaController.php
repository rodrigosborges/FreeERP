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
}
