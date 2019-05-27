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
            $inicio = $data->year.'-'.$data->month.'-01';
            $fim = $data->year.'-'.$data->month.'-31';
            $range = [$inicio,$fim];
            $pagamentos = PagamentoModel::whereBetween('data_vencimento', $range)->get();
            $contas = ContaAPagarModel::all();
            $categorias = CategoriaModel::where('ativo', 1)->get();
            $total = $this->total();
            return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias'));
      }
      
    public function novaConta(){
        
        return view('contaapagar::novaConta'); 
    }
    public function status(){ /*tratar possivel variavel q vir e depois juntar com o filtro de categoria*/
        
        $pagamentoss = PagamentoModel::all();
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
        $total = $this->total_filtro($id);



         return view('contaapagar::index',compact('pagamentos', 'contas', 'total', 'categorias'));
      }
    
    public function total(){
        $data = Carbon::now();
        $inicio = $data->year.'-'.$data->month.'-01';
        $fim = $data->year.'-'.$data->month.'-31';
        $range = [$inicio,$fim];
        $total = 0;
        $pagamentos = PagamentoModel::whereBetween('data_vencimento', $range)->get();
        foreach($pagamentos as $pagamento){
            $total = $total + $pagamento->valor;
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
