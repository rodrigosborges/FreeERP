<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel};
class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('assistencia::paginas.relatorios.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function gerar(Request $req){

        
        $consertos = ConsertoAssistenciaModel::where('deleted_at' , '>=' , $request->data_inicio);
        $consertos = $consertos::where('deleted_at' , '>=' , $request->data_final);
        
        $data = DB::table('conserto_assistencia')->join('ferias', 'funcionario.id', '=', 'ferias.funcionario_id')
            ->join('pagamento', 'funcionario.id', '=', 'pagamento.funcionario_id')
            ->where([
                ['data_inicio', '>=', $dataInicio],
                ['data_fim', '<=', $dataFim],
                ['tipo_pagamento', '=', 'ferias'],
            ])->select('funcionario.nome', 'ferias.data_inicio', 'ferias.data_fim', 'pagamento.total')->get();

        return $data;
    }
    public function create()
    {
        return view('assistencia::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('assistencia::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('assistencia::edit');
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
}
