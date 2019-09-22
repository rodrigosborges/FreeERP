<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Ponto};
use DB;

class FrequenciaController extends Controller{

    public function index($id){
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $funcionario = Funcionario::findOrFail($id);
        $pontos = $funcionario
            ->pontos()
            ->where('entrada', 1)
            ->select(
                DB::raw('YEAR(created_at) ano, MONTH(created_at) mes, MONTHNAME(created_at) nome_mes')
            )
            ->groupby('ano','mes', 'nome_mes')
            ->orderby('ano', 'desc')
            ->orderby('mes', 'desc')
            ->get();

        $data = [
            'title' => "Banco de horas - $funcionario->nome",
            'funcionario' => $funcionario,
            'pontos' => $pontos,
        ];

        return view('funcionario::frequencia.index', compact('data'));
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

            $ultimo = $funcionario->pontos->last();

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

}
