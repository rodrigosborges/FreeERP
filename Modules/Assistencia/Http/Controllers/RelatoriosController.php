<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel,ItemServico,PecaOs};
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
        if($req->status == 1)
            $consertos = ConsertoAssistenciaModel::withTrashed()->get();
        elseif($req->status == 2)
            $consertos = ConsertoAssistenciaModel::onlyTrashed()->get();
        elseif($req->status == 3)
            $consertos = ConsertoAssistenciaModel::all();

        
        if($req->data_inicio)
            $consertos = $consertos->where('deleted_at' , '>=' , $req->data_inicio);
        
        if($req->data_final)
            $consertos = $consertos->where('deleted_at' , '<=' , $req->data_final);
            
        if($req->tipo == 1) {
            $itemServico = ItemServico::all();
            return view('assistencia::paginas.relatorios.servicos', compact('consertos','itemServico'));
        }elseif($req->tipo == 2){
            return view('assistencia::paginas.relatorios.tecnicos', compact('consertos'));
        }elseif($req->tipo == 3){
            $pecaOS = PecaOs::all();
            return view('assistencia::paginas.relatorios.pecas', compact('consertos','pecaOS'));
        }
        
        
       
        
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
