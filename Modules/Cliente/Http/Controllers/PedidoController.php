<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cliente\Http\Requests\CreatePedidoRequest;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\{Cliente, Pedido, Produto};
use DB;
use Carbon\Carbon;

class PedidoController extends Controller
{
   //view listagem
    public function index($cliente_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);
        $pedidosApagados = $cliente->pedidos()->onlyTrashed()->get();
        return view('cliente::pedidos.index', compact('cliente','pedidosApagados'));
    }

    //view novo pedido
    public function novo($cliente_id){

        $cliente = Cliente::findOrFail($cliente_id);
        $produtos = Produto::all();
        
        return view('cliente::pedidos.form', compact('cliente','produtos'));
    }

    

    public function create()
    {
        return view('cliente::create');
    }

    //Salvar Pedido
    public function store(CreatePedidoRequest $request, $id_cliente) {
        $valores = $request->all();
        $valores["cliente_id"] = $id_cliente;
        
        $pedido = Pedido::create($valores);
        DB::beginTransaction();
        try{
            $produtos = $request->input('produtos');

            $dados = [];
            foreach($produtos as $produto){
                if(array_key_exists($produto['produto_id'], $dados)){
                    $dados[$produto['produto_id']]['quantidade'] += $produto['quantidade'];
                }else {
                    $dados[$produto['produto_id']] = [
                        'quantidade' => $produto['quantidade'], 
                        'desconto' => $produto['desconto']
                    ];
                }
                
            }
            $pedido->produtos()->sync($dados);


            DB::commit();

            return redirect('cliente/'.$id_cliente.'/pedido')->with('success','Pedido Salvo!');
        
        } catch (\Exception $e){

            DB::rollback();
            return back()->with('error', 'Erro no servidor!');
        }

       
    }

    
    public function edit($pedido_id)
    {
        $pedido = Pedido::findOrFail($pedido_id);
        $cliente = $pedido->cliente;
        $produtos = Produto::all();

        return view('cliente::pedidos.form', compact('cliente','pedido','produtos'));
    }

    public function update(CreatePedidoRequest $request, $pedido_id)
    {
        $pedido = Pedido::findOrFail($pedido_id);
        $produtos = $request->input('produtos');
        $params = $request->all();

        DB::beginTransaction();
        try{

            $pedido->update($params);
            
            $dados = [];
            foreach($produtos as $produto){
                if(array_key_exists($produto['produto_id'], $dados)){
                    $dados[$produto['produto_id']]['quantidade'] += $produto['quantidade'];
                }else {
                    $dados[$produto['produto_id']] = [
                        'quantidade' => $produto['quantidade'], 
                        'desconto' => $produto['desconto']
                    ];
                }
   
            }

            $pedido->produtos()->sync($dados);
            DB::commit();
           
            return redirect('cliente/'.$pedido->cliente->id.'/pedido')->with('success', 'Pedido editado');
        } catch (\Exception $e){
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao salvar');
        }

    }
    // Deletar ou restaurar varios
    public function deleteMultiples(Request $request){
        $ids = $request->ids;
        $tipo = $request->tipo;

        DB::beginTransaction();
            try{
                if($tipo == "delete"){
                    Pedido::whereIn('id', $ids)->delete();
                    DB::commit();
                    return response()->json(['status'=>true, 'message'=>"Compras excluidas com sucesso"]);
                }else{
                    Pedido::whereIn('id', $ids)->restore();
                    DB::commit();
                    return response()->json(['status'=>true, 'message'=>"Compras recuperadas com sucesso"]);
                }
            }catch(\Exception $e){
                DB::rollback();
                return response()->json(['status'=>false, 'message'=>"Operação não realizada"]);
            }
    }


    public function destroy($pedido_id)
    {   
        $pedido = Pedido::withTrashed()->findOrFail($pedido_id);
        DB::beginTransaction();
        try{
            if( $pedido->trashed() ){
                $pedido->restore();
                DB::commit();
                return back()->with('success', 'Pedido restaurado');
            }else{
                $pedido->delete();
                DB::commit();
                return back()->with('success', 'Pedido deletado');
            }
        } catch (\Exception $e){
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao efetuar a operação');
        }
    }



    public function pdf($cliente_id, $start, $end){
        $cliente = Cliente::findOrFail($cliente_id);
        $start = new Carbon($start);
        $end = new Carbon($end);

        $pedidos = $cliente->pedidos()->whereBetween( 'data', [$start, $end] )->orderBy('data')->get();


        $data = ['cliente' => $cliente, 'pedidos' => $pedidos, 'start' => $start, 'end'=> $end, 
        'data' => $cliente->vl_total_liquido_pedidos($start, $end)];
        
        // dd($data);
        // return view('cliente::pedidos.relatorio', compact('cliente', 'pedido'));
        return \PDF::loadView('cliente::pedidos.relatorio', $data)
                ->setPaper('a4', 'landscape')
                ->stream();
    }


}
