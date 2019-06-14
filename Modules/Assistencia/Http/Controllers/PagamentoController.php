<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel, PagamentoAssistenciaModel};

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index()
     {
       return view('assistencia::paginas.pagamento');
     }

 
    public function salvar(Request $req, $id) {

        $dados = $req->all();
        $forma = '';
        if($dados['forma']==1){
            $forma = 'Dinheiro';
        } else if ($dados['forma']==2) {
            $forma = 'Cartão';
        }
        $pagamento =  PagamentoAssistenciaModel::find($id);
        $pagamento->status = 'Pago';
        $pagamento->forma = $forma;
        $pagamento->save();
        $ativo = 0;
        $conserto = ConsertoAssistenciaModel::find($id);
        $conserto->ativo = $ativo;
        $conserto->save();

        return redirect()->route('consertos.localizar');
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
