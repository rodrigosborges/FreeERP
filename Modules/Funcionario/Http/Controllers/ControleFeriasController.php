<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias, ControleFerias};
use DB;
use DateTime;
use DateInterval;

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

    public function controleFerias($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $cargoAtual = $funcionario->cargos->last()->id;
        $funcionario_cargo =  $funcionario->cargos()->first();
        $admissao = date('d-m-Y', strtotime($funcionario_cargo->pivot->data_entrada));
        $ano = date('Y', strtotime($funcionario_cargo->pivot->data_entrada));
        $ano_atual = date('Y', time());
        //$ano_atual = "2021";
        if($ano == $ano_atual){
            $inicio_periodo_aquisitivo = date('d/m/Y', strtotime($admissao));
            $anos_trampo = 364;
            
        } else {
            $anos_trampo = (($ano_atual-$ano))*364;
            $anos_trampo_inicio = $anos_trampo - 364;
            $inicio_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo_inicio days", strtotime($admissao)));
        }

        $fim_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo days", strtotime($admissao)));
        
        $limite_periodo_aquisitivo = $fim_periodo_aquisitivo;
        $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $limite_periodo_aquisitivo);
        $limite_periodo_aquisitivo->add(new DateInterval('P330D')); // Essa linha adiciona 330 dias(11 meses)

        $teste = DB::table('controle_ferias')->where('funcionario_id', '=', $id)->count(); //Verifica se há algum registro de férias já adicionado.
        
        /*Se há registro, a variável $saldo_periodo armazena o útlimo saldo cadastrado; a váriavel $ultimo_fim_periodo salva o último fim_periodo_aquisitivo, 
        para que seja calculada o saldo excendente*/ 
        if($teste > 0){ 
            $saldo_periodo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo;
            $ultimo_fim_periodo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->fim_periodo_aquisitivo;
            
            //Código de saldo_total
            $data_inicial = $ultimo_fim_periodo; // armazena o fim do periodo em questão 
            $data_final = '2020-11-25'; //Dia que o usuário está usando o software. Essa data é simulada para testes.
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            //Calcula a diferença em dias
            $dias = floor($diferenca / (60 * 60 * 24));
            $meses = floor($dias/30);
            
            $saldo_total = $meses * 2.5; //dias excedentes para se adicionar no saldo_total
            $saldo_periodo += $saldo_total;

        //Senão, manda o saldo de 30 dias, pois não há registro na tabela.
        } else {
            $saldo_periodo = 30;
            $saldo_total = 0;
        }
        
        /*O formato da variavel limite_periodo_aquisito é passado dentro do array pois ele é considerado um objeto, para que ele seja uma string,
        o formato que será apresentado na view deve ser passado dentro do array*/
        $data = [
            'title'                     => 'Ferias',
            'funcionario'               => $funcionario,
            'cargo'                     => Cargo::where('id','=',$cargoAtual)->first(),
            'admissao'                  => $admissao,
            'inicio_periodo_aquisitivo' => $inicio_periodo_aquisitivo,
            'fim_periodo_aquisitivo'    => $fim_periodo_aquisitivo,
            'limite_periodo_aquisitivo' => $limite_periodo_aquisitivo->format('d/m/Y'),
            'saldo_periodo'             => $saldo_periodo,
            'saldo_total'               => $saldo_total
        ];

        return view('funcionario::ferias.formulario', compact('data'));
    }
}

/*$data = '17/11/2014';

$data = DateTime::createFromFormat('d/m/Y', $data);
$data->add(new DateInterval('P2D')); // 2 dias
echo $data->format('d/m/Y');*/