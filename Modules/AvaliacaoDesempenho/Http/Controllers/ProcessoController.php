<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Processo;

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
            'funcionarios' => Funcionario::all(),
        ];

        return view('avaliacaodesempenho::processos/index', compact('moduleInfo', 'menu', 'data'));
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

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('processo');

            foreach ($input as $key => $value) {
                if (empty($value)) {
                    return back()->with('error', 'Todos os campos são obrigatórios.');
                }
            }

            $processo = Processo::create($input);

            DB::commit();

            return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

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
            'funcionarios' => Funcionario::all(),
        ];

        return view('avaliacaodesempenho::processos/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $processo = Processo::findOrFail($id);

            $input = $request->input('processo');

            foreach ($input as $key => $value) {
                if (empty($value)) {
                    return back()->with('error', 'Todos os campos são obrigatórios.');
                }
            }

            $processo->update($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Processo');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $processo = Processo::withTrashed()->findOrFail($id);

            if($processo->trashed()) {

                $processo->restore();

                DB::commit();
                
                return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo ativado com Sucesso');

            } else {
                
                $processo->delete();
                
                DB::commit();

                return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo desativado com Sucesso');
            }

        } catch (\Throwable $th) {
            echo '<pre>';print_r($th->getMessage());exit;
            DB::rollback();

            return redirect('/avaliacaodesempenho/processo')->with('error', 'Não foi possivel realizar a operação desejada. Tente novamente mais tarde.');
        }
    }

    public function search(Request $request)
    {

        $terms = $request->input('term');
        $status = $request->input('status');

        if (empty($terms) && empty($status)) {

            $processos = Processo::withTrashed();

        } else {

            if ($status == '1') {
                $processos = Processo::where('deleted_at', null);
            } else if ($status == '0') {
                $processos = Processo::onlyTrashed();
            } else {
                $processos = Processo::withTrashed();
            }

            foreach ($terms as $key => $term) {
                $processos = $processos->where($key, 'LIKE', '%' . $term . '%');
            }

        }
        $processos = $processos->get();
        
        $table = view('avaliacaodesempenho::processos/_table', compact('processos'))->render();
        return response()->json(['success' => true, 'html' => $table]);
    }
}
