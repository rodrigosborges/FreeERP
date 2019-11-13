<?php

namespace Modules\AvaliacaoDesempenho\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;

use Modules\AvaliacaoDesempenho\Entities\Funcionario;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\Setor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoGestor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario;
use Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao\ResponderAvaliacao;
use Modules\AvaliacaoDesempenho\Http\Requests\Avaliacao\RespostaAvaliacao;

class AvaliacaoRespostaController extends Controller
{
 
    public function index() {

        return view('avaliacaodesempenho::avaliados/index');
    }

    public function responder(ResponderAvaliacao $request) {

        $input = $request->input('avaliado');
        
        $avaliador = Avaliador::where('token', '!=', null)->where('token', $input['token'])->whereHas('funcionario', function(Builder $query) use($input) {
            $query->whereHas('email', function(Builder $query) use($input) {
                $query->where('email', $input['email']);
            });
        })->orderBy('avaliador.created_at', 'desc')->first();

        if (empty($avaliador)) {
            return back()->with('error', 'Funcionario não encontrado');
        }
        
        if (Carbon::today()->greaterThan($avaliador->validade)) {
            return back()->with('error', 'Seu acesso a esta Avaliação expirou');                             
        }

        if ($avaliador->concluido == 1) {
            return back()->with('success', 'Esta Avaliação foi encerrada');                             
        }

        $avaliacao = Avaliacao::findOrFail($avaliador->avaliacao->id);

        if (empty($avaliacao)) {
            return back()->with('error', 'Avaliação não encontrada');
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

            $concluidos = ResultadoFuncionario::whereIn('avaliado_id', $avaliados)->get();
            
            if (count($concluidos)) {

                $data = [];
                foreach ($concluidos as $key => $concluido) {
                    $data[] = $concluido->avaliado->funcionario->id;
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
                return back()->with('success', 'Esta Avaliação foi encerrada');                 
            }

            return view('avaliacaodesempenho::avaliados/avaliar-funcionario', compact('avaliacao', 'questoes', 'avaliador', 'setor', 'funcionarios', 'concluidos'));
        }
    }

    public function resposta(RespostaAvaliacao $request) {
        $input = $request->input('avaliacao');

        DB::beginTransaction();

        try {

            // PROVA PARA AVALIAR FUNCIONARIO
            if ($input['tipo_avaliacao_id'] == 1) {
                
                $funcionario = Funcionario::findOrFail($input['funcionario_id']);
                
                $avaliador = Avaliador::findOrFail($input['avaliador_id']);

                $avaliado = Avaliado::where('avaliacao_id', $input['avaliacao_id'])->where('funcionario_id', $input['funcionario_id'])->first();
                
                $resultado = ResultadoFuncionario::create([
                    'avaliacao_id' => $input['avaliacao_id'],
                    'avaliador_id' => $avaliador->id,
                    'avaliado_id' => $avaliado->id,
                    'respostas' => json_encode($input['questoes'])
                ]);

                if ($resultado->id) {
                                        
                    $avaliacao = $avaliado->avaliacao;
                    $questoes = $avaliacao->questoes;
                    $avaliador = Avaliador::where('avaliacao_id', $avaliacao->id)->first();
                    $setor = $avaliacao->setor;
                    $concluidos = ResultadoFuncionario::where('avaliador_id', $avaliador->id)->get();

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

                    $avaliado->update(['concluido' => 1]);
                    
                    $data = [
                        'avaliador' => $avaliador,
                        'avaliacao' => $avaliacao
                    ];

                    if (count($funcionarios) == 0) {
                        $avaliador->update(['token' => null, 'concluido' => 1]);
                        
                        DB::commit();            

                        Mail::send('avaliacaodesempenho::emails/_feedback', $data, function($message) use($data) {
                            $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Feedback Avaliação');
                        });

                        app('Modules\AvaliacaoDesempenho\Http\Controllers\AvaliacaoController')->updateStatus();
                        app('Modules\AvaliacaoDesempenho\Http\Controllers\ProcessoController')->updateStatus();
                        
                        return redirect('/avaliacaodesempenho/avaliacao')->with('success', 'Avaliação Respondida com Sucesso');                 
                    }
                    
                    DB::commit();

                    Mail::send('avaliacaodesempenho::emails/_feedback', $data, function($message) use($data) {
                        $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Feedback Avaliação');
                    });

                    app('Modules\AvaliacaoDesempenho\Http\Controllers\AvaliacaoController')->updateStatus();
                    app('Modules\AvaliacaoDesempenho\Http\Controllers\ProcessoController')->updateStatus();
                    
                    return view('avaliacaodesempenho::avaliados/avaliar-funcionario', compact('avaliacao', 'questoes', 'avaliador', 'setor', 'funcionarios', 'concluidos'))->with('success', 'Avaliação Respondida com Sucesso');
                
                } else {
                
                    return back()->with('error', 'Algo deu errado');
                }
            
            // PROVA PARA AVALIAR GESTORES
            } else {

                $avaliado = Avaliado::where('avaliacao_id', $input['avaliacao_id'])->first();
                $avaliacao = $avaliado->avaliacao;
                $avaliador = Avaliador::findOrFail($input['avaliador_id']);
                
                $resultado = ResultadoGestor::create([
                    'avaliacao_id' => $input['avaliacao_id'],
                    'avaliador_id' => $avaliador->id,
                    'avaliado_id' => $avaliado->id, 
                    'respostas' => json_encode($input['questoes'])
                    ]);
                    
                if ($resultado->id) {

                    $concluidos = ResultadoGestor::where('avaliado_id', $avaliado->id)->get();

                    $aux = $avaliacao->avaliadores;
                    
                    if (count($avaliacao->avaliadores) == count($concluidos)) {
                        $avaliado->update(['concluido' => 1]);
                    }

                    $avaliador->update(['token' => null, 'concluido' => 1]);
                    
                    DB::commit();

                    $data = [
                        'avaliador' => $avaliador,
                        'avaliacao' => $avaliacao
                    ];

                    Mail::send('avaliacaodesempenho::emails/_feedback', $data, function($message) use($data) {
                        $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Feedback Avaliação');
                    });

                    app('Modules\AvaliacaoDesempenho\Http\Controllers\AvaliacaoController')->updateStatus();
                    app('Modules\AvaliacaoDesempenho\Http\Controllers\ProcessoController')->updateStatus();

                    return back()->with('success', 'Avaliação Respondida com Sucesso');                 
                }
            }

        } catch (\Throwable $th) {
            DB::rollback();

            echo '<pre>';print_r($th->getMessage());exit;

            return back()->with('error', 'Não foi possível salvar as Respostas');
        }
    }

    public function recuperar() {
        return view('avaliacaodesempenho::avaliados/recuperar');        
    }

    public function reenviar(Request $request) {
        $input = $request->input('avaliado');

        $avaliador = Avaliador::where('token', '!=', null)->where('concluido', 0)->whereHas('funcionario', function(Builder $query) use($input) {
            $query->whereHas('email', function(Builder $query) use($input) {
                $query->where('email', $input['email']);
            });
        })->first();

        if (empty($avaliador)) {
            return back()->with('error', 'Funcionario não encontrado');
        }
        
        if (Carbon::today()->greaterThan($avaliador->validade)) {
            return back()->with('error', 'Seu acesso a esta Avaliação expirou');                             
        }

        if ($avaliador->token == null) {
            return back()->with('error', 'Esta Avaliação foi encerrada');                             
        }

        $data = [
            'avaliador' => $avaliador
        ];

        Mail::send('avaliacaodesempenho::emails/_recuperar', $data, function($message) use($data) {
            $message->to($data['avaliador']->funcionario->email->email, $data['avaliador']->funcionario->nome)->subject('Recuperação de Senha');
        });

        return view('avaliacaodesempenho::avaliados/index');
    }
}
