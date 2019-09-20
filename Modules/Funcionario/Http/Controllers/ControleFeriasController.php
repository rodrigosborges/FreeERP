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

        if($ano == $ano_atual){
            $inicio_periodo_aquisitivo = date('d/m/Y', strtotime($admissao));
            $anos_trampo = 364;
            
        } else {
            $anos_trampo = (($ano_atual-$ano)-1)*364;
            $inicio_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo days", strtotime($admissao))) ;
            $teste = $anos_trampo+364;
        }
        $fim_periodo_aquisitivo = date('d/m/Y', strtotime( "+ $anos_trampo days", strtotime($admissao)));
        
        $limite_periodo_aquisitivo = $fim_periodo_aquisitivo;
        $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $limite_periodo_aquisitivo);
        $limite_periodo_aquisitivo->add(new DateInterval('P330D')); // Essa linha adiciona 330 dias(11 meses)

        
       $teste = DB::table('controle_ferias')->where('funcionario_id', '=', $id)->count();
        
        if($teste > 0){
            $saldo_periodo = ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo;
            
        } else {
            $saldo_periodo = 30;
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
            'saldo_periodo'             => $saldo_periodo 
        ];

        return view('funcionario::ferias.formulario', compact('data'));
    }
}

/*$data = '17/11/2014';

$data = DateTime::createFromFormat('d/m/Y', $data);
$data->add(new DateInterval('P2D')); // 2 dias
echo $data->format('d/m/Y');*/