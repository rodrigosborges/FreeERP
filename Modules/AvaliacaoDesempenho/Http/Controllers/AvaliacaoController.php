<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Setor;
use Modules\AvaliacaoDesempenho\Entities\Questao;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;

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

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $input = $request->input('avaliacao');

            $setor = Setor::findOrFail($input['setor_id']);

            foreach ($input as $key => $value) {
                if ($key != 'gestor' && empty($value)) {
                    return back()->with('error', 'Todos os campos são obrigatórios. '.$key);
                }
            }

            $avaliacao = Avaliacao::create($input);

            if ($input['gestor'] == 0) {
                $funcionarios = Funcionario::where('setor_id', $input['setor_id'])->get();
            }
            
            foreach ($funcionarios as $key => $funcionario) {

                if ($funcionario->id != $setor->gestor->id) {
                    $token =  bin2hex(random_bytes(16));
                    $avaliado = Avaliado::create(['funcionario_id' => $funcionario->id, 'avaliacao_id' => $avaliacao->id, 'token' => $token]);
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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $avaliacao = Avaliacao::findOrFail($id);

            $input = $request->input('avaliacao');

            foreach ($input as $key => $value) {
                if ($key != 'gestor' && empty($value)) {
                    return back()->with('error', 'Todos os campos são obrigatórios. '.$key);
                }
            }

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
