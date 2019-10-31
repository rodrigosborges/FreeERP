<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
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

        DB::beginTransaction();
        try {
            $avaliacoesEmAndamento = Avaliacao::has('avaliados')->whereHas('avaliadores', function(Builder $query) {
                $query->where('concluido', 0);
            })->get();
    
            $avaliacoesConcluidas = Avaliacao::has('avaliados')->whereHas('avaliadores', function(Builder $query) {
                $query->where('concluido', 1);
            })->get();            
            
            foreach ($avaliacoesEmAndamento as $key => $avaliacao) {
                $avaliacao->update(['status_id' => 2]);
            }
    
            foreach ($avaliacoesConcluidas as $key => $avaliacao) {
                $avaliacao->update(['status_id' => 3]);
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

            echo '<pre>';print_r($input);exit;

            $setor = Setor::findOrFail($input['setor_id']);

            $input['status_id'] = 1;
            $avaliacao = Avaliacao::create($input);
            $funcionarios = Funcionario::where('setor_id', $input['setor_id'])->get();

            // PROVA PARA AVALIAR GESTORES
            if ($input['tipo_id'] == 2) {

                foreach ($funcionarios as $key => $funcionario) {
    
                    if ($funcionario->id != $setor->gestor->id) {

                        $token =  bin2hex(random_bytes(16));

                        $validade = Carbon::today()->add(10, 'days');

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
                        Mail::send('avaliacaodesempenho::teste', $data, function($message) use($data) {
                            $message->to($data['funcionario']->email->email, 'aksjbdkasbd')->subject('akdbakdbakabdkabdksa');
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
                        $token =  bin2hex(random_bytes(16));

                        $validade = Carbon::today()->add(10, 'days');

                        $avaliador = Avaliador::create([
                            'funcionario_id' => $funcionario->id,
                            'avaliacao_id' => $avaliacao->id,
                            'token' => $token,
                            'validade' => $validade
                        ]);
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
        return view('avaliacaodesempenho::show');
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

    public function search(Request $request)
    {

        $terms = $request->input('term');
        $status = $request->input('status');

        if (empty($terms) && empty($status)) {

            $avaliacoes = Avaliacao::withTrashed();

        } else {

            if ($status == '1') {
                $avaliacoes = Avaliacao::where('deleted_at', null);
            } else if ($status == '0') {
                $avaliacoes = Avaliacao::onlyTrashed();
            } else {
                $avaliacoes = Avaliacao::withTrashed();
            }

            foreach ($terms as $key => $term) {
                $avaliacoes = $avaliacoes->where($key, 'LIKE', '%' . $term . '%');
            }

        }
        $avaliacoes = $avaliacoes->get();
        
        $table = view('avaliacaodesempenho::avaliacoes/_table', compact('avaliacoes'))->render();
        return response()->json(['success' => true, 'html' => $table]);
    }
}
