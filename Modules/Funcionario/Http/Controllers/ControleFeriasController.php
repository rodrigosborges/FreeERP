<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias, ControleFerias};
use DB;
use DateTime;
use DateInterval;
use Carbon\Carbon;

class ControleFeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'title' => 'Ferias',
            'funcionarios' => Funcionario::paginate(10)
        ];
        return view('funcionario::ferias.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'title' => 'Ferias',
        ];
        return view('funcionario::ferias.formulario', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
        
    
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('funcionario::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('funcionario::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function controleFerias($id){
        
        $funcionario = Funcionario::findOrFail($id);
        $cargoAtual = $funcionario->cargos->last()->id;
        $funcionario_cargo =  $funcionario->cargos()->first();
        $admissao = date('d-m-Y', strtotime($funcionario_cargo->pivot->data_entrada));
            
         /**Se a query abaixo retornar maior que 0, é pq há registros na tabela já cadastrados previamente */
        $verifica_registro_tabela = DB::table('controle_ferias')->where('funcionario_id', '=', $id)->count(); 

        if($verifica_registro_tabela == 0){//Verifica se há algum registro de férias já adicionado.
            
            $data_atual =  '2021-09-26'; //Carbon::today();Data que o sistema está sendo acessado. 
            
            //$inicio_periodo_aquisitivo = date('Y-m-d', strtotime($admissao));
            //$anos_trampo = 366;
            //$fim_periodo_aquisitivo = date('Y-m-d', strtotime( "+ $anos_trampo days", strtotime($admissao)));
            $inicio_periodo_aquisitivo = new Carbon($admissao);
            $fim_periodo_aquisitivo = new Carbon($inicio_periodo_aquisitivo);
            $fim_periodo_aquisitivo->addYear();
            
                /*Verifica se está dentro do 1° período possível do funcionário, ou seja, 
                aquele com o inicio_periodo_aquisito sendo a data de admissão.*/ 
                if($data_atual <= $fim_periodo_aquisitivo){ 

                    /*$inicio_periodo_aquisitivo = date('d/m/Y', strtotime($inicio_periodo_aquisitivo));
                    $fim_periodo_aquisitivo = date('d/m/Y', strtotime($fim_periodo_aquisitivo));
                    $limite_periodo_aquisitivo = $fim_periodo_aquisitivo;
                    $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $limite_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->add(new DateInterval('P11M')); // Essa linha adiciona 11 meses*/
                    $limite_periodo_aquisitivo = new Carbon($fim_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->addMonths(11);

                    $saldo_periodo = 30;
                    
                } else { 
                    
                    /*$ano_atual = date('Y', time()); //'2021'; Essa data é simulada para teste; 
                    $ano = date('Y', strtotime($funcionario_cargo->pivot->data_entrada));
                    $admissao = date('Y-m-d', strtotime($funcionario_cargo->pivot->data_entrada));

                    $anos_trampo = (($ano_atual-$ano))*364;
                    $anos_trampo_inicio = ($anos_trampo - 364) +1;

                    $fim_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo days", strtotime($admissao)));
                    $inicio_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo_inicio days", strtotime($admissao)));
                    
                    $teste = DateTime::createFromFormat('Y-m-d', $admissao);
                    $teste->add(new DateInterval('P365D'));*/

                    $ano_atual = '2021'; //date('Y', time()); ; 
                    $admissao = date('Y-m-d', strtotime($funcionario_cargo->pivot->data_entrada));
                    
                    $diaAdmissao = date('d', strtotime($admissao));
                    $mesAdmissao = date('m', strtotime($admissao));

                    $diaAtual = '26'; //date('d', time()); //'21';
                    $mesAtual = '09'; //date('m', time()); //'10';
                   
                        if($diaAtual <= $diaAdmissao && $mesAtual <= $mesAdmissao){
                            $inicio_periodo_aquisitivo = new Carbon($admissao);
                            $inicio_periodo_aquisitivo->year($ano_atual)->subYear();
                            
                            $fim_periodo_aquisitivo = new Carbon($admissao);
                            $fim_periodo_aquisitivo->year($ano_atual);

                        } else {
                            $inicio_periodo_aquisitivo = new Carbon($admissao);
                            $inicio_periodo_aquisitivo->year($ano_atual);
                            
                            $fim_periodo_aquisitivo = new Carbon($inicio_periodo_aquisitivo);
                            $fim_periodo_aquisitivo->addYear();
                        }
                    
                    $limite_periodo_aquisitivo = new Carbon($fim_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->addMonths(11);

                    $teste = new Carbon($admissao);
                    $teste->addYear(); 

                    $diferenca = strtotime($data_atual) - strtotime($teste->format('Y-m-d'));

                    $dias = floor($diferenca / (60 * 60 * 24));
                    $saldo_periodo = 30;

                        while($dias > 0){
                            $saldo_periodo += 2.5;
                            $dias -= 30;
                        }    
                    
                }
             
        } else {
            
            $data_atual = Carbon::today(); //'2022-10-21';Data que o sistema está sendo acessado
            $data_atual = Carbon::parse($data_atual)->format('Y-m-d');
            $ultimo_periodo_aquisitivo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->fim_periodo_aquisitivo;
            
                if($data_atual <= $ultimo_periodo_aquisitivo){ //Se está no mesmo perído que o registrado anteriormente.
                
                    /*$inicio_periodo_aquisitivo = DateTime::createFromFormat('Y-m-d', ControleFerias::where('funcionario_id', '=', $id)
                                                 ->get()->last()->inicio_periodo_aquisitivo);
                    $fim_periodo_aquisitivo = DateTime::createFromFormat('Y-m-d', $ultimo_periodo_aquisitivo);

                    $limite_periodo_aquisitivo = $fim_periodo_aquisitivo;
                    $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $limite_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->add(new DateInterval('P11M')); // Essa linha adiciona 330 dias(11 meses)*/
                    $inicio_periodo_query = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->inicio_periodo_aquisitivo;
                    
                    $inicio_periodo_aquisitivo = new Carbon($inicio_periodo_query);
                    $fim_periodo_aquisitivo = new Carbon($ultimo_periodo_aquisitivo);
                    $limite_periodo_aquisitivo = new Carbon($fim_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->addMonths(11);
                    $saldo_periodo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo;
                   
                } else {
                    $ano_atual = date('Y', time()); //'2022'; 
                    //$ano = date('Y', strtotime($funcionario_cargo->pivot->data_entrada));
                    $admissao = date('d-m-Y', strtotime($funcionario_cargo->pivot->data_entrada));
                    
                    $diaAdmissao = date('d', strtotime($admissao));
                    $mesAdmissao = date('m', strtotime($admissao));

                    $diaAtual = date('d', time()); //'21';
                    $mesAtual = date('m', time()); //'10';
                   
                        if($diaAtual <= $diaAdmissao && $mesAtual <= $mesAdmissao){
                            $inicio_periodo_aquisitivo = new Carbon($admissao);
                            $inicio_periodo_aquisitivo->year($ano_atual)->subYear();
                            
                            $fim_periodo_aquisitivo = new Carbon($admissao);
                            $fim_periodo_aquisitivo->year($ano_atual);

                        } else {
                            $inicio_periodo_aquisitivo = new Carbon($admissao);
                            $inicio_periodo_aquisitivo->year($ano_atual);
                            
                            $fim_periodo_aquisitivo = new Carbon($inicio_periodo_aquisitivo);
                            $fim_periodo_aquisitivo->addYear();
                        }
                    /*$anos_trampo = (($ano_atual-$ano))*365;
                    $anos_trampo_inicio = ($anos_trampo - 365) +1;

                    $fim_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo days", strtotime($admissao)));
                    $inicio_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo_inicio days", strtotime($admissao)));
                    
                    $limite_periodo_aquisitivo = $fim_periodo_aquisitivo;
                    $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $limite_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->add(new DateInterval('P11M')); // Essa linha adiciona 330 dias(11 meses)*/
                    $limite_periodo_aquisitivo = new Carbon($fim_periodo_aquisitivo);
                    $limite_periodo_aquisitivo->addMonths(11);

                    $saldo_periodo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo;
                    $data_inicial = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->fim_periodo_aquisitivo; // armazena o fim do periodo em questão
                    
                    $data_final = $data_atual; //Dia que o usuário está usando o software. Essa data é simulada para testes.
                    
                    $diferenca = strtotime($data_final) - strtotime($data_inicial);
                    
                    //Calcula a diferença em dias
                    $dias = floor($diferenca / (60 * 60 * 24));
                    
                    //$meses = floor($dias/30);
                
                    //$saldo_periodo = 0;

                    while($dias > 0){
                        $saldo_periodo += 2.5;
                        $dias -= 30;
                    }            
                    
                }
        }

        /*O formato da variavel limite_periodo_aquisito é passado dentro do array pois ele é considerado um objeto, para que ele seja uma string,
        o formato que será apresentado na view deve ser passado dentro do array*/
        $data = [
            'title'                     => 'Férias',
            'funcionario'               => $funcionario,
            'cargo'                     => Cargo::where('id','=',$cargoAtual)->first(),
            'admissao'                  => $admissao,
            'inicio_periodo_aquisitivo' => $inicio_periodo_aquisitivo->format('d/m/Y'),
            'fim_periodo_aquisitivo'    => $fim_periodo_aquisitivo->format('d/m/Y'),
            'limite_periodo_aquisitivo' => $limite_periodo_aquisitivo->format('d/m/Y'),
            'saldo_periodo'             => $saldo_periodo,
        ];
       
        return view('funcionario::ferias.formulario', compact('data'));
    }
}

/*$data = '17/11/2014';

$data = DateTime::createFromFormat('d/m/Y', $data);
$data->add(new DateInterval('P2D')); // 2 dias
echo $data->format('d/m/Y');*/