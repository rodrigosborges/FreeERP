<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Funcionario\Http\Requests\CreateFerias;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias, ControleFerias, Documento};
use DB;
use DateTime;
use DateInterval;
use Carbon\Carbon;

class FeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'title' => 'Lista de Funcionários',
            'funcionarios' => Funcionario::all(),
        ];
        return view('funcionario::ferias.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('funcionario::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateFerias $request)
    {
        DB::beginTransaction();

		try{
            
            /*Estas linhas fazer com que seja possivel a inversão das datas sem dar problemas,
             só é preciso agora passar o formato no create para salvar no banco.*/
            $inicio_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['inicio_periodo_aquisitivo']);
            $fim_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['fim_periodo_aquisitivo'])->format('Y-m-d');
            $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['limite_periodo_aquisitivo']);

            //Esta linha verifica se já há algum registro na tabela controle_ferias.
            $verificarRegistroTabela = DB::table('controle_ferias')->where('funcionario_id', '=', $request['funcionario_id'])->count();

            //Verificação se há, se houver, ele pega o último atributo que está salvo no banco e subtrai com os dias inseridos no input.
            if($verificarRegistroTabela > 0){ // esse if verifica caso seja no mesmo período
                
                $ultimo_periodo_aquisitivo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->fim_periodo_aquisitivo;

                if($ultimo_periodo_aquisitivo == $fim_periodo_aquisitivo){
                    $saldoTotalBanco = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo;
                    $saldo_periodo = $saldoTotalBanco - $request->dias_ferias;
                    $saldo_total = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_total;
                }

            //Senão, ele subtrai os dias inseridos por 30, pois a cada periodo aquisitivo o funcionário tem direito a 30 dias.     
            } else {
                $saldo_periodo = 30 - $request->dias_ferias;
                $saldo_total = 0;
            }

            $controleFerias = ControleFerias::Create([
                'inicio_periodo_aquisitivo'  => $inicio_periodo_aquisitivo->format('Y-m-d'),
                'fim_periodo_aquisitivo'     => $fim_periodo_aquisitivo,
                'limite_periodo_aquisitivo'  => $limite_periodo_aquisitivo->format('Y-m-d'),
                'saldo_total'                => $saldo_total,
                'saldo_periodo'              => $saldo_periodo,
                'funcionario_id'             => $request['funcionario_id']
            ]);
                
            
            if($request->pagamento_parcela13 == "on"){
                $pagamento13 = true;
            }else{
                $pagamento13 = false;
            }
           
            $ferias = Ferias::Create([
                'data_inicio'           => date('Y-m-d', strtotime($request['data_inicio'])),
                'data_fim'              => date('Y-m-d', strtotime($request['data_fim'])),
                'dias_ferias'           => $request->dias_ferias,
                'data_pagamento'        => date('Y-m-d', strtotime($request['data_pagamento'])),
                'data_aviso'            => date('Y-m-d', strtotime($request['data_aviso'])),
                'situacao_ferias'       => $request['situacao_ferias'],
                'pagamento_parcela13'   => $pagamento13,
                'observacao'            => $request['observacao'],
                'funcionario_id'        => $request['funcionario_id'],
                'controle_ferias_id'    => $controleFerias->id
            ]);
            
			DB::commit();
			return redirect('funcionario/ferias')->with('success', 'Férias cadastrada com sucesso!');
		} catch(Exception $e){
			DB::rollback();
			return back();
		}
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {         
        
        $ferias = Ferias::findOrFail($id); 
        $funcionario = Funcionario::where('id','=', $ferias->funcionario_id)->get()->last()->nome;
        $funcionario2 = Funcionario::find($ferias->funcionario_id);
        $documentos  = $funcionario2->documento->where('tipo_documento_id', 4);
        $cargo = Cargo::where('id' , '=',$ferias->funcionario_id)->get()->last()->nome;
        $inicio_periodo_aquisitivo = ControleFerias::where('id', '=', $ferias->controle_ferias_id)->get()->last()->inicio_periodo_aquisitivo;
        $fim_periodo_aquisitivo = ControleFerias::where('id', '=', $ferias->controle_ferias_id)->get()->last()->fim_periodo_aquisitivo;    
        
        $carteiraTrabalho = DB::table('funcionario')->join('funcionario_has_documento', 'funcionario_has_documento.funcionario_id', '=', 'funcionario.id')
                                ->join('documento', 'documento.id', '=', 'funcionario_has_documento.documento_id')
                                ->where('documento.tipo_documento_id', '=', '4')->get()->last()->numero;
                                    
        $serieCarteiraTrabalho =  DB::table('funcionario')->join('funcionario_has_documento', 'funcionario_has_documento.funcionario_id', '=', 'funcionario.id')
                                 ->join('documento', 'documento.id', '=', 'funcionario_has_documento.documento_id')
                                 ->where('documento.tipo_documento_id', '=', '8')->get()->last()->numero;
                
        return view('funcionario::ferias.show', compact('ferias', 'funcionario','cargo', 'inicio_periodo_aquisitivo', 'fim_periodo_aquisitivo', 'carteiraTrabalho', 'serieCarteiraTrabalho'));
    }
    
    public function listar($id)
    {   
        $data = [
            'title' => 'Lista de Funcionários',
            'ferias' => Ferias::where('funcionario_id','=',$id)->get(),
        ];
        return view('funcionario::ferias.listar', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $funcionario = funcionario::findorFail($id);   
        $ferias = $funcionario->ferias->last();
       
        $data = [
            'title' => 'Editar Férias',
            'ferias' => Ferias::where('funcionario_id','=',$id)->get()->last(),
            'saldo_periodo' => ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo
        ];
        
        return view('funcionario::ferias.editaFerias',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id) {   

        if($request->pagamento_parcela13 == "on"){
            $pagamento13 = true;
        }else{
            $pagamento13 = false;
        }

        //Esta query pega o ultimo saldo disponível do periodo 
        $saldo_periodo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo;
        
        //Esta variável armazena o valor no campo de dias que o usuário digitou na tela
        $dias_ferias_inseridos = $request->dias_ferias;
        
        //Esta guarda o valor que já está cadastada no banco os dias de férias marcados.
        $dias_ferias_banco = Ferias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->dias_ferias;

        /*O if verifica se os dias que o usuário digitou são maiores do que está guardado no banco, caso for, 
        ele pega o saldo e subtrai da diferença dos dias inseridos com os ja cadastrados no banco (pois o novo saldo será menor que o cadastrado), senão,
        o saldo_periodo é somado com a diferença entre os dias de férias ja cadastrado no banco com os nvoos dias inseridos (o novo saldo será maior que o cadastrado anteriormente)*/
        if($dias_ferias_inseridos > $dias_ferias_banco) {
            $saldo_periodo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo - ($dias_ferias_inseridos - $dias_ferias_banco);
            
        } else {
            $saldo_periodo =  ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo + ($dias_ferias_banco - $dias_ferias_inseridos);
            
        }
       
        DB::beginTransaction();

        try {
            
            $ferias = Ferias::findOrFail($id);
            $controleFerias = ControleFerias::findOrFail($id);
            
            $controleFerias->update(['saldo_periodo' => $saldo_periodo]);
        
            $ferias->update([
                'data_inicio'          => date('Y-m-d', strtotime($request['data_inicio'])),
                'data_fim'             => date('Y-m-d', strtotime($request['data_fim'])),
                'dias_ferias'          => $request->dias_ferias,
                'data_pagamento'       => date('Y-m-d', strtotime($request['data_pagamento'])),
                'data_aviso'           => date('Y-m-d', strtotime($request['data_aviso'])),
                'situacao_ferias'      => $request['situacao_ferias'],
                'pagamento_parcela13'  => $pagamento13,
                'observacao'           => $request['observacao'],
                'funcionario_id'       => $request['funcionario_id'],
                'controle_ferias_id'   => $ferias->id
            ]);
            
            DB::commit();
           
            return redirect('funcionario/ferias')->with('success', 'Férias atualizada com sucesso');
        } catch(Exception $e){
            DB::rollback();
            return $e;
        }
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
}
