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
    }

    public function index($id){
        $funcionario = Funcionario::findOrFail($id);
        $pontos = $funcionario
            ->pontos()
            ->where('entrada', 1)
            ->select(
                DB::raw('YEAR(created_at) ano, MONTH(created_at) mes, MONTHNAME(created_at) nome_mes, funcionario_id as funcionario_id'),
            )
            ->groupby('ano','mes', 'nome_mes', 'funcionario_id')
            ->orderby('ano', 'desc')
            ->orderby('mes', 'desc')
            ->get();

        foreach($pontos as $key => $ponto){
            $data = $this->get_data($id, $ponto->ano, $ponto->mes);
            $pontos[$key]['hasAutomatico'] = $data === null ? 1 : 0;
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

        $data['title'] = "Edição de ponto - ".$data['funcionario']->nome." - ".ucfirst(strftime('%B de %Y', strtotime($data['pontos'][0]->created_at)));
        $data['id'] = $id;
        $data['ano'] = $ano;
        $data['mes'] = $mes;

        return view('funcionario::frequencia.form', compact('data'));
    }

    public function update(PontoEdit $request, $id, $ano, $mes){
        try{

            foreach($request->stored as $key => $stored){
                $date = \DateTime::createFromFormat('d/m/Y H:i:s', $stored);
                $date = $date->format('Y-m-d H:i:s');
                $ponto = Ponto::findOrFail($key);
                if($ponto->created_at != $date){
                    $ponto->created_at = $date;
                    $ponto->updated_at = date('Y-m-d H:i:s');
                    $ponto->automatico = 0;
                    $ponto->update();
                }
            }

            $funcionario = Funcionario::findOrFail($id);

            if($request->entrada && $request->saida){
                foreach($request->entrada as $entrada){
                    
                    $date = \DateTime::createFromFormat('d/m/Y H:i:s', $entrada);
                    $date = $date->format('Y-m-d H:i:s');

                    $funcionario->pontos()->create([
                        'entrada'       => 1,
                        'automatico'    => 0,
                        'created_at'    => $date,
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }

                foreach($request->saida as $saida){
                    
                    $date = \DateTime::createFromFormat('d/m/Y H:i:s', $saida);
                    $date = $date->format('Y-m-d H:i:s');

                    $funcionario->pontos()->create([
                        'entrada'       => 0,
                        'automatico'    => 0,
                        'created_at'    => $date,
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

            $dateEn = date('Y-m-d H:i:s');

            $dateBr = date('d/m/Y H:i:s');

            $funcionario = Funcionario::findOrFail($id);

            $entrada = 1;
            
            $mensagem = "Entrada registrada";

            $ultimo = $funcionario->pontos()->orderby('created_at')->last();

            if($ultimo && $ultimo->entrada == 1){
                $diferenca = round((strtotime($dateEn) - strtotime($ultimo->created_at)) / (60*60));

                if($diferenca > 10){
                    $funcionario->pontos()->create([
                        'created_at' => $dateEn,
                        'entrada'    => 0,
                        'automatico' => 1,
                    ]);
                    $mensagem = "Entrada registrada (Saída anterior registrada automaticamente)";
                }else{
                    $entrada = 0;
                    $hour = intval((strtotime($dateEn) - strtotime($ultimo->created_at)) / (60*60));
                    $tempo = date('i:s',(strtotime($dateEn) - strtotime($ultimo->created_at)));
                    $mensagem = "Saída registrada (Tempo: $hour:$tempo)";
                }
            }
            
            $funcionario->pontos()->create([
                'created_at' => $dateEn,
                'entrada'    => $entrada,
            ]);

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
            ->where('created_at', '>=', $ano."-".$mes."-01 00:00:00")
            ->where('created_at', '<', $ano."-".($mes+1)."-01 00:00:00")
            ->orderby('created_at');

        $pontosCheck = clone $pontos;

        if($pontosCheck->count() == 0 || ($pontosCheck->where('automatico', 1)->count() > 0 && !$edit)){
            return null;
        }

        $pontos = $pontos->get();
        
        if($pontos[0]->entrada == 0){
            unset($pontos[0]);
        }

        if($pontos[count($pontos)-1]->entrada == 1){
            $ponto = $funcionario
                ->pontos()
                ->where('entrada', 0)
                ->where('created_at', '>=', $ano."-".($mes+1)."-01 00:00:00")
                ->where('created_at', '<', $ano."-".($mes+2)."-01 00:00:00")
                ->orderby('created_at')
                ->first();

            if($ponto->automatico == 1 && !$edit){
                return null;
            }else{
                $pontos[] = $ponto;
            }
        }

        $hours = 0;
        $minutes = 0;
        $seconds = 0;

        for($i=0; $i < count($pontos); $i+=2){
            $timeWorked = $pontos[$i]->timeTo($pontos[$i+1]);

            $secondsNew = explode(':',$timeWorked);
            $secondsNew = intVal(($secondsNew)[2]);

            $minutesNew = explode(':',$timeWorked);
            $minutesNew = intVal(($minutesNew)[1]);

            $hoursNew = explode(':',$timeWorked);
            $hoursNew = intVal(($hoursNew)[0]);

            $hours = ( ($seconds + $secondsNew)/60 + $minutes + $minutesNew)/60 + $hoursNew + $hours;
            $minutes = (($seconds + $secondsNew)/60 + ($minutes + $minutesNew))%60;
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
