<?php

namespace Modules\ContaAPagar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAPagar\Entities\PagamentoModel;
use Modules\ContaAPagar\Entities\ContaAPagarModel;
use Modules\ContaAPagar\Entities\CategoriaModel;
use Carbon\Carbon;
    
class ContaAPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index(){
            $data = Carbon::now();
            $pagamentos = PagamentoModel::whereMonth('data_vencimento', $data->month)->whereYear('data_vencimento', $data->year)->where('ativo', 1)->get();
            $contas = ContaAPagarModel::where('ativo', 1)->get();
            $categorias = CategoriaModel::where('ativo', 1)->get();
            $total = $this->total();
            return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias'));
      }
    
    public function deletar($id){
        $conta = ContaAPagarModel::find($id);
        $conta->ativo = false;
        $conta->update();
        
        $pagamentos = PagamentoModel::where('conta_pagar_id', $conta->id)->get();
        foreach($pagamentos as $pagamento){
            $pagamento->ativo = false;
            $pagamento->update();
        }
        return $this->index();
    }
    public function editar($id){
        $conta = ContaAPagarModel::find($id);
        $pagamentos = PagamentoModel::where('conta_pagar_id', $id)->where('ativo', 1)->get();
        $categorias = CategoriaModel::where('ativo', 1)->get();
        return view('contaapagar::editarConta',compact('conta', 'pagamentos','categorias'));
    }

    public function filtrar(Request $req){
        $dados = $req->all();
            $data = Carbon::now();
            $range = [$dados['data_inicial'],$dados['data_final']];
            $pagamentos = PagamentoModel::whereBetween('data_pagamento', $range)->where('ativo', 1)->get();
            $contas = ContaAPagarModel::where('ativo', 1)->get();
            $categorias = CategoriaModel::where('ativo', 1)->get();
            $total = $this->totalFiltro($range);
            return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias'));        
    }

    public function salvar(Request $req, $id){
        
        $dados = ContaAPagarModel::find($id);
        $dados->descricao = $req['descricao'];
        $dados->valor = $req['valor'];
        $dados->parcelas = $req['parcelas'];
        $dados->categoria_pagar_id = $req['categoria_pagar_id'];
        $dados->update();
        
        return redirect()->route('contaapagar');
    }
    public function cadastrarConta(Request $req){
        
        $dados = $req->all();

        ContaAPagarModel::create($dados);
        $conta_pagar_id = ContaAPagarModel::latest()->first();
            
        
        for ($i=0; $i < $dados['parcelas'] ; $i++) {
            if($i >= 1){
                $pagamento = new PagamentoModel;
                $pagamento->numero_parcela = $i;
                $pagamento->juros = $dados['juros'];
                $pagamento->multa = $dados['multa'];
                $pagamento->conta_pagar_id = $conta_pagar_id->id;
                $pagamento->data_vencimento = date('Y-m-d', strtotime($dados['data_vencimento']. ' + '. $i .'months'));
                $pagamento->data_pagamento = date('Y-m-d', strtotime($dados['data_pagamento']. ' + '. $i .'months'));
                $pagamento->status_pagamento = "Aguardando";   
                $pagamento->valor = $dados['valor']/$dados['parcelas'];
                $pagamento->save();                
            }else{
                $pagamento = new PagamentoModel;
                $pagamento->numero_parcela = $i;
                $pagamento->juros = $dados['juros'];
                $pagamento->multa = $dados['multa'];
                $pagamento->conta_pagar_id = $conta_pagar_id->id;
                $pagamento->data_vencimento = $dados['data_vencimento'];
                $pagamento->data_pagamento = $dados['data_pagamento'];
                if($dados['status_pagamento'] == 'on'){
                    $pagamento->status_pagamento = "Pago";    
                }else{
                    $pagamento->status_pagamento = "Aguardando";   
                }
                $pagamento->valor = $dados['valor']/$dados['parcelas'];
                $pagamento->save();
            }
        }
        
        return $this->index();
    }
    
      
    public function novaConta(){
            $categorias = CategoriaModel::where('ativo', 1)->get();        
        return view('contaapagar::novaConta', compact('categorias')); 
    }
    public function status(){ /*tratar possivel variavel q vir e depois juntar com o filtro de categoria*/
        
        $pagamentoss = PagamentoModel::where('ativo', 1)->get();
        $pagamentos = [];
        
        foreach($pagamentoss as $pagamento){
            
            if($pagamento->status_pagamento == 'Aguardando'){
                array_push($pagamentos, $pagamento);
            }

        }
        $categorias = CategoriaModel::where('ativo', 1)->get();
        $contas = ContaAPagarModel::all();
        
        $total = 0;
        foreach($pagamentos as $pagamento){
            $total = $total + $pagamento->valor;
        }

        
        return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias')); 
      }
    
     public function filtro($id){ 
        $data = Carbon::now();
        $inicio = $data->year.'-'.$data->month.'-01';
        $fim = $data->year.'-'.$data->month.'-31';
        $range = [$inicio,$fim];
        $pagamento = PagamentoModel::whereBetween('data_vencimento', $range)->get();
        $pagamentos = [];
         
         foreach($pagamento as $pg){
             if($pg->categoria_conta($pg->conta_pagar_id) == $id){
                 array_push($pagamentos, $pg);
             }
         }
         
        $contas = ContaAPagarModel::where('categoria_pagar_id', $id);
        $categorias = CategoriaModel::where('ativo', 1)->get();
        $total = $this->totalFiltro($range);



         return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias'));
      }
    
    public function total(){
        $data = Carbon::now();
        $total = 0;
        $pagamentos = PagamentoModel::whereMonth('data_vencimento', $data->month)->whereYear('data_vencimento', $data->year)->where('ativo', 1)->get();
        foreach($pagamentos as $pagamento){
            $total = $total + $pagamento->valor + $pagamento->juros + $pagamento->multa;
        }
        return $total;
    }

    public function totalFiltro($range){
        $data = Carbon::now();
        $total = 0;
        $pagamentos = PagamentoModel::whereBetween('data_vencimento', $range)->where('ativo', 1)->get();
        foreach($pagamentos as $pagamento){
            $total = $total + $pagamento->valor + $pagamento->juros + $pagamento->multa;
        }
        return $total;
    }
    
    public function total_filtro($id){
        $data = Carbon::now();
        $inicio = $data->year.'-'.$data->month.'-01';
        $fim = $data->year.'-'.$data->month.'-31';
        $range = [$inicio,$fim];
        $total = 0;

        $pagamento = PagamentoModel::whereBetween('data_vencimento', $range)->get();
         $pagamentos = [];
         
         foreach($pagamento as $pg){
             if($pg->categoria_conta($pg->conta_pagar_id) == $id){
                 array_push($pagamentos, $pg);
             }
         }        
        
        foreach($pagamentos as $pgs){
            $total = $total + $pgs->valor;
        }
        return $total;
    }    
    
    
    public function list(){
        
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
