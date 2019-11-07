<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;

use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Setor;
use Modules\AvaliacaoDesempenho\Entities\Questao;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao\StoreAvaliacao;
use Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao\UpdateAvaliacao;

class AvaliacaoController extends Controller
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
        $data = [
            'processos' => Processo::all(),
            'funcionarios' => Funcionario::all(),
            'setores' => Setor::all()
        ];

        $avaliacoes = Avaliacao::all();

        DB::beginTransaction();
        try {

            foreach ($avaliacoes as $i => $avaliacao) {

                if ($avaliacao->tipo->id == 2) {
                    $definido = 1;
                    $encerrado = 1;

                    foreach ($avaliacao->avaliadores as $j => $avaliador) {

                        if ($avaliador->concluido == 1) {
                            $definido = 0;
                        }

                        if ($avaliador->concluido == 0) {
                            $encerrado = 0;
                        }
                    }

                    if ($encerrado == 1) {
                        $avaliacao->update(['status_id' => 3]);
                    }

                    if ($definido == 1) {
                        $avaliacao->update(['status_id' => 1]);
                    }

                    if ($definido == 0 && $encerrado == 0 ) {
                        $avaliacao->update(['status_id' => 2]);
                    }

                } else if ($avaliacao->tipo->id == 1) {
                    $definido = 1;
                    $encerrado = 1;

                    foreach ($avaliacao->avaliados as $j => $avaliado) {

                        if ($avaliado->concluido == 1) {
                            $definido = 0;
                        }

                        if ($avaliado->concluido == 0) {
                            $encerrado = 0;
                        }
                    }

                    if ($encerrado == 1) {
                        $avaliacao->update(['status_id' => 3]);
                    }

                    if ($definido == 1) {
                        $avaliacao->update(['status_id' => 1]);
                    }

                    if ($definido == 0 && $encerrado == 0 ) {
                        $avaliacao->update(['status_id' => 2]);
                    }
                }

                $data_fim = implode('-', array_reverse(explode('/', $avaliacao->data_fim)));

                if (Carbon::today()->greaterThan($data_fim) && $avaliacao->status->id != 3) {
                    $avaliacao->update(['status_id' => 4]);
                }
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;
        }

        return view('avaliacaodesempenho::avaliacoes/index', compact('moduleInfo', 'menu', 'data'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'processos' => Processo::all(),
            'funcionarios' => Funcionario::all(),
            'setores' => Setor::all(),
            'questoes' => Questao::all()
        ];

        return view('avaliacaodesempenho::avaliacoes/create', compact('moduleInfo', 'menu', 'data'));
    }

    public function store(StoreAvaliacao $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('avaliacao');
            
            $setor = Setor::findOrFail($input['setor_id']);

            $input['status_id'] = 1;

            $avaliacao = Avaliacao::create($input);

            $avaliacao->questoes()->sync($input['questoes']);

            $funcionarios = Funcionario::where('setor_id', $setor->id)->get();

            // PROVA PARA AVALIAR GESTORES
            if ($input['tipo_id'] == 2) {

                foreach ($funcionarios as $key => $funcionario) {

                    if ($funcionario->id != $setor->gestor->id) {

                        $token = bin2hex(random_bytes(16));

                        $validade = implode('-', array_reverse(explode('/', $input['data_fim'])));

                        $avaliador = Avaliador::create([
                            'funcionario_id' => $funcionario->id,
                            'avaliacao_id' => $avaliacao->id,
                            'token' => $token,
                            'validade' => $validade
                        ]);

                        $data = [
                            'funcionario' => $funcionario,
                            'avaliacao' => $avaliacao,
                            'token' => $token,
                            'validade' => $validade
                        ];

                        Mail::send('avaliacaodesempenho::emails/_email', $data, function($message) use($data) {
                            $message->to($data['funcionario']->email->email, 'Funcionário')->subject('Avaliação de Desempenho');
                        });

                    } else if ($funcionario->id == $setor->gestor->id) {

                        $avaliado = Avaliado::create([
                            'funcionario_id' => $funcionario->id,
                            'avaliacao_id' => $avaliacao->id
                        ]);
                    }
                }

            // PROVA PARA AVALIAR FUNCIONARIOS
            } else if ($input['tipo_id'] == 1) {

                foreach ($funcionarios as $key => $funcionario) {

                    if ($funcionario->id != $setor->gestor->id) {

                        $avaliado = Avaliado::create([
                            'funcionario_id' => $funcionario->id,
                            'avaliacao_id' => $avaliacao->id,
                        ]);

                    } else if ($funcionario->id == $setor->gestor->id) {
                        $token = bin2hex(random_bytes(16));

                        $validade = implode('-', array_reverse(explode('/', $input['data_fim'])));

                        $avaliador = Avaliador::create([
                            'funcionario_id' => $funcionario->id,
                            'avaliacao_id' => $avaliacao->id,
                            'token' => $token,
                            'validade' => $validade
                        ]);

                        $data = [
                            'funcionario' => $funcionario,
                            'avaliacao' => $avaliacao,
                            'token' => $token,
                            'validade' => $validade,
                            'setor' => $setor
                        ];

                        Mail::send('avaliacaodesempenho::emails/_email', $data, function($message) use($data) {
                            $message->to($data['funcionario']->email->email, 'Gestor')->subject('Avaliação de Desempenho');
                        });
                    }
                }
            }

            DB::commit();

            return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Avaliação Criada com Sucesso');

        } catch (\Throwable $th) {

            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível cadastrar a Avaliação');
        }
    }

    public function show($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $avaliacao = Avaliacao::findOrFail($id);
        $setor = Setor::findOrFail($avaliacao->setor->id);

        $data = [
            'avaliacao' => $avaliacao,
            'setor' => $setor,
        ];

        return view('avaliacaodesempenho::avaliacoes/show', compact('moduleInfo', 'menu', 'data'));
    }

    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'avaliacao' => Avaliacao::findOrFail($id),
            'processos' => Processo::all(),
            'funcionarios' => Funcionario::all(),
            'setores' => Setor::all()
        ];

        return view('avaliacaodesempenho::avaliacoes/edit', compact('moduleInfo', 'menu', 'data'));
    }

    public function update(UpdateAvaliacao $request, $id)
    {
        DB::beginTransaction();

        try {

            $avaliacao = Avaliacao::findOrFail($id);

            $input = $request->input('avaliacao');

            $avaliacao->update($input);

            DB::commit();

            return redirect('avaliacaodesempenho/avaliacao')->with('success', 'Avaliação cadastrada com sucesso.');

        } catch (\Throwable $th) {

            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possivel editar a Avaliação');
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
