<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Ponto, Log};
use Modules\Funcionario\Helpers\PontoExport;
use Modules\Funcionario\Http\Requests\{PontoCreate, PontoEdit};
use DB;

class FrequenciaController extends Controller{

    public function __construct(){
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        DB::statement("SET lc_time_names = 'pt_BR'");
    }

    public function index($id){

        $funcionario = Funcionario::findOrFail($id);

        $pontos = $funcionario
            ->pontos()
            ->select(
                DB::raw('YEAR(entrada) ano, MONTH(entrada) mes, MONTHNAME(entrada) nome_mes'),
            )
            ->groupby('ano','mes', 'nome_mes')
            ->orderby('ano', 'desc')
            ->orderby('mes', 'desc')
            ->get();

        foreach($pontos as $key => $ponto){
            $hasAutomatico = $funcionario
                                ->pontos()
                                ->where('entrada', '>=', $ponto->ano."-".$ponto->mes."-01 00:00:00")
                                ->where('entrada', '<', $ponto->ano."-".($ponto->mes+1)."-01 00:00:00")
                                ->where('automatico', 1)
                                ->count(); 
            $pontos[$key]['hasAutomatico'] = $hasAutomatico > 0;
        }

        $data = [
            'title' => "Banco de horas - $funcionario->nome",
            'funcionario' => $funcionario,
            'pontos' => $pontos,
        ];

        return view('funcionario::frequencia.index', compact('data'));
    }

    public function horasdiarias(Request $request, $id){
        try{  
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->horas_diarias = $request->horas_diarias;
            $funcionario->update();
            return back()->with('success', 'Horas diárias atualizada com sucesso.');
        }catch(Exception $e){
            return back()->with('error', 'Funcionário não encontrado.');
        }
    }

    public function pdf($id, $ano, $mes){
        
        $data = $this->get_data($id, $ano, $mes);

        if($data === null){
            return back()->with('error', 'Os registros de ponto contém registros automáticos, favor verificá-los.');
        }else{
            $pdf = \PDF::loadView('funcionario::frequencia.pdf', compact('data'));
            return $pdf->stream();
        }

    }

    public function xls($id, $ano, $mes){
        
        $data = $this->get_data($id, $ano, $mes);
        
        if($data === null){
            return back()->with('error', 'Os registros de ponto contém registros automáticos, favor verificá-los.');
        }else{
            return \Excel::download(new PontoExport($data), $data['funcionario']->nome." $mes $ano.xls");
        }

    }

    public function edit($id, $ano, $mes){
        
        $data = $this->get_data($id, $ano, $mes, true);

        $data['title'] = "Edição de ponto - ".$data['funcionario']->nome." - ".ucfirst(strftime('%B de %Y', strtotime($data['pontos'][0]->entrada)));
        $data['id'] = $id;
        $data['ano'] = $ano;
        $data['mes'] = $mes;

        return view('funcionario::frequencia.form', compact('data'));
    }

    public function update(PontoEdit $request, $id, $ano, $mes){
        try{

            foreach($request->stored as $key => $stored){
                $entrada = \DateTime::createFromFormat('d/m/Y H:i:s', $stored['entrada']);
                $entrada = $entrada->format('Y-m-d H:i:s');
                $saida = \DateTime::createFromFormat('d/m/Y H:i:s', $stored['saida']);
                $saida = $saida->format('Y-m-d H:i:s');
                $ponto = Ponto::findOrFail($key);
                $funcionario = $ponto->funcionario;
                if($ponto->entrada != $entrada || $ponto->saida != $saida || ($ponto->justificativa != null && $ponto->justificativa != $stored['justificativa'])){
                    
                    if($ponto->entrada != $entrada){
                        Log::create([
                            'mensagem'  => "Entrada do ponto(id:$key) alterada de $ponto->entrada para $entrada do funcionário $funcionario->nome(id:$funcionario->id).",
                            'created_at'=> date('Y-m-d H:i:s')
                        ]);
                    }

                    if($ponto->saida != $saida){
                        Log::create([
                            'mensagem'  => "Saída do ponto(id:$key) alterada de $ponto->saida para $saida do funcionário $funcionario->nome(id:$funcionario->id).",
                            'created_at'=> date('Y-m-d H:i:s')
                        ]);
                    }

                    if($ponto->justificativa != null && $ponto->justificativa != $stored['justificativa']){
                        Log::create([
                            'mensagem'  => "Justificativa do ponto(id:$key) alterada de ".$ponto->justificativa." para ".$stored['justificativa']." do funcionário $funcionario->nome(id:$funcionario->id).",
                            'created_at'=> date('Y-m-d H:i:s')
                        ]);
                    }

                    $ponto->entrada = $entrada;
                    $ponto->saida = $saida;
                    $ponto->justificativa = $stored['justificativa'];
                    $ponto->updated_at = date('Y-m-d H:i:s');
                    $ponto->automatico = 0;$ponto->saida = $saida;
                    $ponto->justificativa = $stored['justificativa'];
                    $ponto->updated_at = date('Y-m-d H:i:s');
                    $ponto->automatico = 0;
                    $ponto->update();
                }
            }

            $funcionario = Funcionario::findOrFail($id);

            if($request->new){
                foreach($request->new as $new){
                    $entrada = \DateTime::createFromFormat('d/m/Y H:i:s', $new['entrada']);
                    $entrada = $entrada->format('Y-m-d H:i:s');

                    $saida = \DateTime::createFromFormat('d/m/Y H:i:s', $new['saida']);
                    $saida = $saida->format('Y-m-d H:i:s');

                    $funcionario->pontos()->create([
                        'entrada'       => $entrada,
                        'saida'         => $saida,
                        'justificativa' => $new['justificativa'],
                        'automatico'    => 0,
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }
            }

            return redirect("funcionario/frequencia/$id")->with('success', 'Ponto atualizado com sucesso!');
        }catch(Exception $e){
            return back()->withInput()->with('error', 'Erro no servidor');
        }
    }

    public function list(Request $request) {
        $funcionarios = new Funcionario;

        if($request['search']) {
            $funcionarios = $funcionarios->where('nome', 'like', '%'.$request['search'].'%');
        }

        return response()->json(
            $funcionarios->orderBy('nome')
                ->orderBy('biometria')
                ->with(['documento' => function($q) {
                    $q->where('tipo_documento_id', 1)->select("numero")->first();
                }])
                ->select('id','nome','biometria')                
                ->paginate(5));
    }

    public function biometry(Request $request,$id){
        try{  
            if($request->biometria){
                $funcionario = Funcionario::findOrFail($id);
                $funcionario->biometria = $request->biometria;
                $funcionario->update();
                return json_encode(true);
            }
            else{
                return json_encode(false);
            }
        }catch(Exception $e){
            return json_encode(false);
        }
    }

    public function biometricUsers(){
        return response()->json(Funcionario::whereNotNull('biometria')->select('id','nome','biometria')->get());
    }

    public function ponto($id){
        try{

            DB::beginTransaction();

            $dateEn = date('Y-m-d H:i:s');

            $date = date('Y-m-d');

            $dateBr = date('d/m/Y H:i:s');

            $funcionario = Funcionario::findOrFail($id);

            $ferias = $funcionario->ferias()->where('data_inicio', '<=', $date)->where('data_fim', '>=', $date);
            if($ferias->count() > 0){
                $ferias = $ferias->first();

                return json_encode([
                    'horario'   => $dateBr,
                    'mensagem'  => "Não foi possível registrar a entrada.<br>Funcionário encontra-se de férias  de ".date("d/m/Y", strtotime($ferias->data_inicio))." até ".date("d/m/Y", strtotime($ferias->data_fim)).".",
                ]);
            }

            $licenca = $funcionario->atestados()->where('data_inicio', '<=', $date)->where('data_fim', '>=', $date);
            if($licenca->count() > 0){
                $licenca = $licenca->first();

                return json_encode([
                    'horario'   => $dateBr,
                    'mensagem'  => "Não foi possível registrar a entrada.<br>Funcionário encontra-se de licença de ".date("d/m/Y", strtotime($licenca->data_inicio))." até ".date("d/m/Y", strtotime($licenca->data_fim)).".",
                ]);
            }
            
            $mensagem = "Entrada registrada";

            $ultimo = $funcionario->pontos()->whereNull('saida')->orderBy('entrada', 'desc')->first();

            if($ultimo){
                $diferenca = round((strtotime($dateEn) - strtotime($ultimo->entrada)) / (60*60));

                $ultimo->saida = $dateEn;
                $ultimo->update();

                if($diferenca > $funcionario->horas_diarias){
                    $ultimo->automatico = 1;
                    $ultimo->update();

                    $funcionario->pontos()->create([
                        'entrada'    => $dateEn,
                    ]);

                    $mensagem = "Entrada registrada (Saída anterior registrada automaticamente)";

                }else{                 
                    $hour = intval((strtotime($ultimo->saida) - strtotime($ultimo->entrada)) / (60*60));
                    $tempo = date('i:s',(strtotime($ultimo->saida) - strtotime($ultimo->entrada)));
                    $mensagem = "Saída registrada (Tempo: $hour:$tempo)";
                }

            }else{
                $funcionario->pontos()->create([
                    'entrada'   => $dateEn
                ]);
            }
            
            DB::commit();

            return json_encode([
                'horario'   => $dateBr,
                'mensagem'  => $mensagem,
            ]);

        }catch(Exception $e){
            return json_encode(false);
        }
    }

    public static function get_data($id, $ano, $mes, $edit = false){

        $funcionario = Funcionario::findOrFail($id);

        $pontos = $funcionario
            ->pontos()
            ->where('entrada', '>=', $ano."-".$mes."-01 00:00:00")
            ->where('entrada', '<', $ano."-".($mes+1)."-01 00:00:00")
            ->orderby('entrada');

        $pontosCheck = clone $pontos;

        if($pontosCheck->count() == 0 || ($pontosCheck->where('automatico', 1)->count() > 0 && !$edit)){
            return null;
        }

        $pontos = $pontos->get();

        $hours = 0;
        $minutes = 0;
        $seconds = 0;

        foreach($pontos as $ponto){
            $timeWorked = $ponto->time_worked();

            $secondsNew = explode(':',$timeWorked);
            $secondsNew = intVal(($secondsNew)[2]);

            $minutesNew = explode(':',$timeWorked);
            $minutesNew = intVal(($minutesNew)[1]);

            $hoursNew = explode(':',$timeWorked);
            $hoursNew = intVal(($hoursNew)[0]);

            $hours = intVal(( ($seconds + $secondsNew)/60 + $minutes + $minutesNew)/60 + $hoursNew + $hours);
            $minutes = intVal((($seconds + $secondsNew)/60 + ($minutes + $minutesNew))%60);
            $seconds = ($seconds + $secondsNew)%60;
        }

        $total = ($hours < 10 ? "0$hours" : $hours).":".($minutes < 10 ? "0$minutes" : $minutes).":".($seconds < 10 ? "0$seconds" : $seconds);

        $data = [
            'title'         => "$funcionario->nome $mes $ano.pdf",
            'funcionario'   => $funcionario,
            'pontos'        => $pontos,
            'total'         => $total,
        ];

        return $data;
    }

}
