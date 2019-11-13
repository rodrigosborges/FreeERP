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

            return back()->with('error', 'Não foi possível cadastrar o Setor')->withInput($request->input());
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

            return back()->with('error', 'Não foi possível cadastrar o Setor')->withInput($request->input());
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
}
