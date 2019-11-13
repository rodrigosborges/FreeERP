<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Http\Requests\Processo\StoreProcesso;
use Modules\AvaliacaoDesempenho\Http\Requests\Processo\UpdateProcesso;

class ProcessoController extends Controller
{

    protected $moduleInfo;

    protected $menu;

    public function __construct()
    {
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
            'funcionarios' => Funcionario::all(),
        ];

        $this->updateStatus();

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

    public function store(StoreProcesso $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('processo');

            $processo = Processo::create($input);

            DB::commit();

            return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo Criado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Processo')->withInput($request->input());
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

    public function update(UpdateProcesso $request, $id)
    {
        DB::beginTransaction();

        try {
            $processo = Processo::findOrFail($id);

            $input = $request->input('processo');

            $processo->update($input);

            DB::commit();
            return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo Atualizado com Sucesso');

        } catch (\Throwable $th) {

            echo '<pre>';
            print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar o Processo')->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $processo = Processo::withTrashed()->findOrFail($id);

            if ($processo->trashed()) {

                $processo->restore();

                DB::commit();

                return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo ativado com Sucesso');

            } else {

                $processo->delete();

                DB::commit();

                return redirect('/avaliacaodesempenho/processo')->with('success', 'Processo desativado com Sucesso');
            }

        } catch (\Throwable $th) {
            echo '<pre>';
            print_r($th->getMessage());exit;
            DB::rollback();

            return redirect('/avaliacaodesempenho/processo')->with('error', 'Não foi possivel realizar a operação desejada. Tente novamente mais tarde.');
        }
    }

    public function updateStatus() {
        $processos = Processo::all();

        DB::beginTransaction();
        try {
            foreach ($processos as $key => $processo) {

                if (count($processo->avaliacoes) > 0) {

                    $definido = 1;
                    $encerrado = 1;
    
                    foreach ($processo->avaliacoes as $key => $avaliacao) {
    
                        if ($avaliacao->status->id == 1 || $avaliacao->status->id == 2 || $avaliacao->status->id == 4) {
                            $encerrado = 0;
                        }
    
                        if ($avaliacao->status->id == 2 || $avaliacao->status->id == 3 || $avaliacao->status->id == 4) {
                            $definido = 0;
                        }
                    }
    
                    if ($definido == 1) {
                        $processo->update(['status_id' => 1]);
                    }
                    if ($encerrado == 1) {
                        $processo->update(['status_id' => 3]);
                    }
                    if ($definido == 0 && $encerrado == 0) {
                        $processo->update(['status_id' => 2]);
                    }
    
                    $data_fim = implode('-', array_reverse(explode('/', $processo->data_fim)));
    
                    if (Carbon::today()->greaterThan($data_fim) && $processo->status->id != 3) {
                        $processo->update(['status_id' => 4]);
                    }
                }
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;
        }
    }
}
