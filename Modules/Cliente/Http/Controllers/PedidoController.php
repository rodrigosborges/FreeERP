<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB; 
class PedidoController extends Controller
{
   
    public function index()
    {
        $cliente = DB::table('cliente')->where('id',2)->get();
        //  dd($cliente);
        return view('cliente::pedidos.index', compact('cliente'));
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
