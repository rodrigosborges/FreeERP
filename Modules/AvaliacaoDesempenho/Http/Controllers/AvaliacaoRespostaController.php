<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\Setor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoGestor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario;

class AvaliacaoRespostaController extends Controller
{
 
    public function index() {
        return view('avaliacaodesempenho::avaliados/index');
    }

    public function responder(Request $request) {

        $input = $request->input('avaliado');

        foreach ($input as $key => $value) {

            if (empty($value)) {
                return back()->with('error', 'Todos os campos são obrigatorios.');
            }
        }

        $avaliador = Avaliador::where('token', $input['token'])->first();
        
        if (empty($avaliador)) {
            return back()->with('error', 'Funcionario não encontrado.');
        }

        $avaliacao = Avaliacao::findOrFail($avaliador->avaliacao->id);

        if (empty($avaliacao)) {
            return back()->with('error', 'Avaliação não encontrada.');
        }

        $questoes = $avaliacao->questoes;

        // SE A PROVA EH PARA AVALIAR GESTORES
        if ($avaliacao->tipo->id == 2) {

            return view('avaliacaodesempenho::avaliados/avaliar-gestor', compact('avaliacao', 'questoes', 'avaliador'));
        
        //SE A PROVA EH PARA AVALIAR FUNCIONARIOS
        } else if ($avaliacao->tipo->id == 1) {

            $setor = $avaliacao->setor;

            $aux = Avaliado::where('avaliacao_id', $avaliacao->id)->get();
            $avaliados = [];
            foreach ($aux as $key => $avaliado) {
                $avaliados[] = $avaliado->id;
            }

            $concluidos = ResultadoGestor::whereIn('avaliado_id', $avaliados)->get();
            
            if (count($concluidos)) {

                $data = [];
                foreach ($concluidos as $key => $concluido) {
                    $data[] = $concluido->funcionario->id;
                }
                
                $funcionarios = Funcionario::where('setor_id', $setor->id)
                    ->where('id', '<>', $avaliador->funcionario->id)
                    ->whereNotIn('id', $data);

            } else {

                $funcionarios = Funcionario::where('setor_id', $setor->id)
                    ->where('id', '<>', $avaliador->funcionario->id);               
            }

            $funcionarios = $funcionarios->get();

            if (count($funcionarios) == 0) {
                return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Esta Avaliação já foi encerrada');                 
            }

            return view('avaliacaodesempenho::avaliados/avaliar-funcionario', compact('avaliacao', 'questoes', 'avaliador', 'setor', 'funcionarios', 'concluidos'));
        }
    }

    public function resposta(Request $request) {
        $input = $request->input('avaliacao');

        DB::beginTransaction();

        try {

            // PROVA PARA AVALIAR FUNCIONARIO
            if ($input['tipo_avaliacao_id'] == 1) {
                
                $funcionario = Funcionario::findOrFail($input['funcionario_id']);
                
                $avaliado = Avaliado::where('avaliacao_id', $input['avaliacao_id'])->where('funcionario_id', $input['funcionario_id'])->first();
                
                $resultado = ResultadoFuncionario::create([
                    'avaliado_id' => $avaliado->id,
                    'respostas' => json_encode($input['questoes'])
                ]);
                
                if ($resultado->id) {
                    
                    $avaliacao = $avaliado->avaliacao;
                    $questoes = $avaliacao->questoes;
                    $avaliador = Avaliador::where('avaliacao_id', $avaliacao->id)->first();
                    $setor = $avaliacao->setor;
                    $concluidos = ResultadoFuncionario::where('avaliado_id', $avaliado->id)->get();
                    
                    if (count($concluidos)) {
                        
                        $data = [];
                        foreach ($concluidos as $key => $concluido) {
                            $data[] = $concluido->avaliado->funcionario->id;
                        }
                        
                        $funcionarios = Funcionario::where('setor_id', $setor->id)
                            ->where('id', '<>', $avaliador->funcionario->id)
                            ->where('id', '<>', $input['funcionario_id'])
                            ->whereNotIn('id', $data);

                    } else {

                        $funcionarios = Funcionario::where('setor_id', $setor->id)
                            ->where('id', '<>', $avaliador->funcionario->id)
                            ->where('id', '<>', $input['funcionario_id']);                  
                    }

                    $funcionarios = $funcionarios->get();

                    
                    if (count($funcionarios) == 0) {
                        $avaliador->update(['token' => null, 'concluido' => 1]);
                        
                        DB::commit();

                        return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Avaliação Respondida com Sucesso');                 
                    }
                    
                    DB::commit();

                    return view('avaliacaodesempenho::avaliados/avaliar-funcionario', compact('avaliacao', 'questoes', 'avaliador', 'setor', 'funcionarios', 'concluidos'))->with('success', 'Avaliação Respondida com Sucesso');
                }
            
            // PROVA PARA AVALIAR FUNCIONARIOS
            } else {

                $avaliado = Avaliado::where('avaliacao_id', $input['avaliacao_id'])->first();

                $resultado = ResultadoGestor::create([
                    'avaliado_id' => $avaliado->id, 
                    'respostas' => json_encode($input['questoes'])
                ]);

                if ($resultado->id) {
                    $avaliador->update(['token' => null, 'concluido' => 1]);
                    
                    DB::commit();

                    return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Avaliação Respondida com Sucesso');                    
                }
            }

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível salvar as Respostas');
        }

    }
}
