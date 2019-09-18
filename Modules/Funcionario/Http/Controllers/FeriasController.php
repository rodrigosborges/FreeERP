<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias, ControleFerias, Documento};
use DB;
use DateTime;
use DateInterval;

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
    public function store(Request $request)
    {
        DB::beginTransaction();

		try{
           
            $inicio_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['inicio_periodo_aquisitivo']);
            $fim_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['fim_periodo_aquisitivo']);
            $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['limite_periodo_aquisitivo']);

            $controleFerias = ControleFerias::Create([
                'inicio_periodo_aquisitivo' => $inicio_periodo_aquisitivo->format('Y-m-d'),
                'fim_periodo_aquisitivo' => $fim_periodo_aquisitivo->format('Y-m-d'),
                'limite_periodo_aquisitivo' => $limite_periodo_aquisitivo->format('Y-m-d'),
                'saldo_total' => 0,
                'saldo_periodo' => 0,
                'funcionario_id' => $request['funcionario_id']
            ]);
  
            if($request->pagamento_parcela13 == "on"){
                $pagamento13 = true;
            }else{
                $pagamento13 = false;
            }
           

            $ferias = Ferias::Create([
                'data_inicio' => date('Y-m-d', strtotime($request['data_inicio'])),
                'data_fim' => date('Y-m-d', strtotime($request['data_fim'])),
                'dias_ferias' => $request->dias_ferias,
                'data_pagamento' => date('Y-m-d', strtotime($request['data_pagamento'])),
                'data_aviso' => date('Y-m-d', strtotime($request['data_aviso'])),
                'situacao_ferias' => $request['situacao_ferias'],
                'pagamento_parcela13' => $pagamento13,
                'observacao' => $request['observacao'],
                'funcionario_id' => $request['funcionario_id'],
                'controle_ferias_id' => $controleFerias->id
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


    /*DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();*/
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
        
        DB::beginTransaction();

        try {
            $ferias = Ferias::findOrFail($id);
            $ferias->update([
                'data_inicio' => date('Y-m-d', strtotime($request['data_inicio'])),
                'data_fim' => date('Y-m-d', strtotime($request['data_fim'])),
                'dias_ferias' => $request->dias_ferias,
                'data_pagamento' => date('Y-m-d', strtotime($request['data_pagamento'])),
                'data_aviso' => date('Y-m-d', strtotime($request['data_aviso'])),
                'situacao_ferias' => $request['situacao_ferias'],
                'pagamento_parcela13' => $pagamento13,
                'observacao' => $request['observacao'],
                'funcionario_id' => $request['funcionario_id']
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
