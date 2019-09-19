<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cliente\Http\Requests\CreatePedidoRequest;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\{Cliente, Pedido, Produto};
use DB;

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

    
    public function store(CreatePedidoRequest $request)
    {
        $pedido = Pedido::create( $request->all() );
        DB::beginTransaction();
        try{
            $produtos = $request->input('produtos');
            $dados = [];
            foreach($produtos as $produto){
                $dados[$produto['produto_id']] = [
                        'quantidade' => $produto['quantidade'], 
                        'desconto' => $produto['desconto']
                    ];
                }

                $pedido->produtos()->sync($dados);

            DB::commit();
                return back()->with('sucess','Pedido Salvo');
        } catch (\Exception $e){
            DB::rollback();
                return back()->with('error', 'Ocorreu um erro ao salvar');
        }
        $pedido->produtos()->sync($dados);

        return back()->with('sucess','Pedido Salvo');
    }

    
    // public function show($id)
    // {
    //     return view('cliente::show');
    // }

    
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
            $dados[$produto['produto_id']] = [
                    'quantidade' => $produto['quantidade'], 
                    'desconto' => $produto['desconto']
                ];
            }

            $pedido->produtos()->sync($dados);
            DB::commit();
            return back()->with('sucess', 'Pedido editado');
        } catch (\Exception $e){
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao salvar');
        }

        $pedido->produtos()->sync($dados);

        return back()->with('sucess', 'Pedido editado');
    }

    public function destroy($pedido_id)
    {   
        $pedido = Pedido::withTrashed()->findOrFail($pedido_id);
        if( $pedido->trashed() ){
            $pedido->restore();
            return back()->with('sucess', 'Pedido restaurado');
        }else{
            $pedido->delete();
            return back()->with('success', 'Pedido deletado');
        }
    }
}
