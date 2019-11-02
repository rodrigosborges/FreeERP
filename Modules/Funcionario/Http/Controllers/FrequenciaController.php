<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Ponto};
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
                DB::raw('YEAR(entrada) ano, MONTH(entrada) mes, MONTHNAME(entrada) nome_mes, funcionario_id as funcionario_id'),
            )
            ->groupby('ano','mes', 'nome_mes', 'funcionario_id')
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
                if($ponto->entrada != $entrada || $ponto->saida != $saida){
                    $ponto->entrada = $entrada;
                    $ponto->saida = $saida;
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

        if($request['pesquisa']) {
            $funcionarios = $funcionarios->where('nome', 'like', '%'.$request['pesquisa'].'%');
        }

        return response()->json($funcionarios->orderBy('biometria')->orderBy('nome')->select('id','nome','biometria')->paginate(10));
    }

    public function biometry(Request $request,$id){
        try{  
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->biometria = $request->biometria;
            $funcionario->update();
            return json_encode(true);
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

            if($funcionario->ferias()->where('data_inicio', '<=', $date)->where('data_fim', '>=', $date)->count() > 0){
                return json_encode([
                    'horario'   => $dateBr,
                    'mensagem'  => "Não foi possível registrar a entrada.<br>Funcionário se encontra de férias.",
                ]);
            }

            if($funcionario->atestados()->where('data_inicio', '<=', $date)->where('data_fim', '>=', $date)->count() > 0){
                return json_encode([
                    'horario'   => $dateBr,
                    'mensagem'  => "Não foi possível registrar a entrada.<br>Funcionário se encontra de atestado.",
                ]);
            }
            
            $mensagem = "Entrada registrada";

            $ultimo = $funcionario->pontos()->whereNull('saida')->orderBy('entrada', 'desc')->first();

            if($ultimo){
                $diferenca = round((strtotime($dateEn) - strtotime($ultimo->entrada)) / (60*60));

                $ultimo->saida = $dateEn;
                $ultimo->update();

                if($diferenca > 10){
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
