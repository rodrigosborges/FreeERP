<?php

namespace Modules\ContaAPagar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAPagar\Entities\{ContaAPagarModel,PagamentoModel,CategoriaModel};

class PagamentoController extends Controller
{
    
    public function categoria_conta($id_conta){
        $conta = ContaAPagarModel::where('id', $id_conta)->first();
        return $conta->categoria_pagar_id;
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contaapagar::index');
    }
    public function salvar(Request $req, $id) {

        $dados = $req->all();

        if($dados['status_pagamento'] == 'on'){
            $dados['status_pagamento'] = "Pago";    
        }else{
            $dados['status_pagamento'] = "Aguardando";   
        }
        $pagamento = PagamentoModel::find($id)->update($dados);

        $categorias = CategoriaModel::where('ativo', 1)->get();
        $pagamentos = PagamentoModel::where('conta_pagar_id', $id)->get();
        $conta = ContaAPagarModel::find($id);

        return redirect()->route('conta.editar', compact('id','pagamentos','categorias','conta'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contaapagar::create');
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
        return view('contaapagar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('contaapagar::edit');
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
