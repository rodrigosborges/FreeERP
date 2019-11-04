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

        $processos = Processo::all();

        DB::beginTransaction();
        try {
            foreach ($processos as $key => $processo) {

                $definido = 1;
                $encerrado = 1;

                foreach ($processo->avaliacoes as $key => $avaliacao) {

                    if ($avaliacao->status->id == 1) {
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

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;
        }

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

    public function update(UpdateProcesso $request, $id)
    {
        DB::beginTransaction();

        try {
            $processo = Processo::findOrFail($id);

            $input = $request->input('processo');

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
