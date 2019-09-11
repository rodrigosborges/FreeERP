<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\{Cliente, Pedido, Produto};
use DB; 

class PedidoController extends Controller
{
   //view listagem
    public function index($cliente_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);
        $pedidos = $cliente->pedidos;
        return view('cliente::pedidos.index', compact('cliente'));
    }

    //view novo pedido
    public function novo($cliente_id){

        $cliente = Cliente::findOrFail($cliente_id);
        $produtos = Produto::all();
        
        return view('cliente::pedidos.form', compact('cliente','produtos'));
    }

    public function buscaItem(Request $request){

    }
    

    public function create()
    {
        return view('cliente::create');
    }

    
    public function store(Request $request)
    {
        
        $pedido = Pedido::create( $request->all() );
        

        return $pedido;
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($pedido_id)
    {   
        $pedido = Pedido::findOrFail($pedido_id);

        $pedido->delete();
        return back()->with('success', 'Pedido deletado');
    }
}
