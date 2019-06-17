<?php

namespace Modules\ContaAReceber\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAReceber\Entities\PagamentoModel;
use Modules\ContaAReceber\Entities\ContaAReceberModel;
use Modules\ContaAReceber\Entities\CategoriaModel;
use Modules\ContaAReceber\Entities\FormaPagamentoModel;
use Carbon\Carbon;

class ContaAReceberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index(){
            $data = Carbon::now();
            $pagamentos = PagamentoModel::whereMonth('data_pagamento', $data->month)->whereYear('data_pagamento', $data->year)->get();
            $contas = ContaAReceberModel::all();
            $categorias = CategoriaModel::all();
            $formapgs = FormaPagamentoModel::all();
            $total = $this->total();
            return view('contaareceber::index',compact('pagamentos', 'contas', 'total', 'categorias', 'formapgs', 'data'));
      }

    public function editar($id){
        $conta = ContaAReceberModel::find($id);

        $pagamento = PagamentoModel::where('conta_receber_id', $id)->get()->first();
        $categorias = CategoriaModel::all();
        $formapgs = FormaPagamentoModel::all();

        return view('contaareceber::editarConta',compact('conta', 'pagamento','categorias', 'formapgs'));
    }

    public function salvar(Request $req, $id){
        $dados = $req->all();

        $conta = ContaAReceberModel::find($id);
        $conta->descricao = $dados['descricao'];
        $conta->valor = $dados['valor'];
        $conta->categoria_receber_id = $dados['categoria_receber_id'];

        $pagamento = PagamentoModel::where('conta_receber_id', $conta->id)->first();
        $pagamento->valor = $conta->valor;
        $pagamento->data_pagamento = $dados['data_pagamento'];
        $forma_pagamento_id = $dados['forma_pagamento_id'];
        if($dados['status_pagamento'] == 'on'){
            $pagamento->status_pagamento = "Pago";
        }else{
            $pagamento->status_pagamento = "Aguardando";
        }
        $pagamento->forma_pagamento_id = $dados['forma_pagamento_id'];
        $formapg = FormaPagamentoModel::find($dados['forma_pagamento_id']);
        $pagamento->taxa = $formapg->taxa;
        $pagamento->data_recebimento = date('Y-m-d', strtotime($dados['data_pagamento']. ' + '. $formapg->prazo_recebimento .'days'));


        $conta->update();
        $pagamento->update();

        return redirect()->route('contaareceber');
    }

    public function total(){
        $data = Carbon::now();
        $total = 0;
        $pagamentos = PagamentoModel::whereMonth('data_pagamento', $data->month)->whereYear('data_pagamento', $data->year)->get();
        foreach($pagamentos as $pagamento){
            $total = $total + ($pagamento->valor-($pagamento->valor*$pagamento->taxa/100));
        }
        return $total;
    }

    public function totalFiltro($range){
        $data = Carbon::now();
        $total = 0;
        $pagamentos = PagamentoModel::whereBetween('data_pagamento', $range)->get();
        foreach($pagamentos as $pagamento){
            $total = $total + ($pagamento->valor-($pagamento->valor*$pagamento->taxa/100));
        }
        return $total;
    }

    public function filtrar(Request $req){
        $dados = $req->all();
            $data = Carbon::now();
            $range = [$dados['data_inicial'],$dados['data_final']];
            $pagamentos = PagamentoModel::whereBetween('data_pagamento', $range)->get();
            $contas = ContaAReceberModel::all()->get();
            $categorias = CategoriaModel::all()->get();
            $formapgs = FormaPagamentoModel::all()->get();
            $total = $this->totalFiltro($range);
            return view('contaareceber::index',compact('pagamentos', 'contas', 'total', 'categorias', 'formapgs'));
    }

    public function cadastrarConta(Request $req){

        $dados = $req->all();
        ContaAReceberModel::create($dados);
        $conta_receber_id = ContaAReceberModel::latest()->first();

        $pagamento = new PagamentoModel;
        $pagamento->conta_receber_id = $conta_receber_id->id;
        $pagamento->valor = $dados['valor'];
        $pagamento->data_pagamento = $dados['data_pagamento'];
        if($dados['status_pagamento'] == 'on'){
            $pagamento->status_pagamento = "Pago";
        }else{
            $pagamento->status_pagamento = "Aguardando";
        }
        $pagamento->forma_pagamento_id = $dados['forma_pagamento_id'];

        $formapg = FormaPagamentoModel::find($dados['forma_pagamento_id']);


        $pagamento->taxa = $formapg->taxa;
        $pagamento->data_recebimento = date('Y-m-d', strtotime($dados['data_pagamento']. ' + '. $formapg->prazo_recebimento .'days'));

        $pagamento->save();

        return $this->index();
    }

    public function deletar($id){
        $conta = ContaAReceberModel::find($id);
        $conta->delete();
        $conta->update();

        $pagamentos = PagamentoModel::where('conta_receber_id', $conta->id)->get();
        foreach($pagamentos as $pagamento){
            $pagamento->delete();
            $pagamento->update();
        }
        return $this->index();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contaareceber::create');
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
        return view('contaareceber::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('contaareceber::edit');
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
