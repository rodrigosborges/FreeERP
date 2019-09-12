<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias, ControleFerias};
use DB;

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
                'funcionario_id' => $request['funcionario_id']
            ]);
            
            $controleFerias = ControleFerias::Create([
                'inicio_periodo_aquisitivo' => date('Y-m-d', strtotime($request['inicio_periodo_aquisitivo'])),
                'fim_periodo_aquisitivo' => date('Y-m-d', strtotime($request['fim_periodo_aquisitivo'])),
                'saldo_total' => 0,
                'saldo_periodo' => 0,
                'funcionario_id' => $request['funcionario_id']
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
    public function show($id)
  
    {         

        $ferias = Ferias::findOrFail($id); 
        
        $funcionarios = Funcionario::where('id',    '=', $ferias->funcionario_id)->get();
        $cargo = Cargo::where('id' , '=',$ferias->funcionario_id)->get();


            
        return view('funcionario::ferias.show', compact('ferias', 'funcionarios','cargo'));
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
        $ferias = Ferias::findOrFail($id);
        return view('funcionario::ferias.editaFerias',compact('ferias'));
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
