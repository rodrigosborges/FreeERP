<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\{Cliente, Pedido, Produto};
use DB; 

class PedidoController extends Controller
{
   
    public function index($id)
    {
        $cliente = Cliente::findOrFail($id);
        $pedidos = $cliente->pedidos;

        return view('cliente::pedidos.index', compact('cliente'));
    }
    public function novo($id){
        $cliente = Cliente::findOrFail($id);
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
        //
    }

    
    // public function show($id)
    // {
    //     return view('cliente::show');
    // }

    
    public function edit($id)
    {
        return view('cliente::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
