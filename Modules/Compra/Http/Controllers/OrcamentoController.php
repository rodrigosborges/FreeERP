<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Compra\Entities\{Pedido,ItemCompra,Fornecedor};

class OrcamentoController extends Controller
{
    
    protected $moduleInfo;
    protected $menu;

    public function  __construct(){
        $this->moduleInfo = [
            'icon' => 'store',
            'name' => 'COMPRA',
        ];
        $this->menu = [
            ['icon' => 'shop', 'tool' => 'Itens', 'route' => '/compra/itemCompra/'],
            ['icon' => 'library_books', 'tool' => 'Pedidos', 'route' => '/compra/pedido/'],
            ['icon' => 'local_shipping', 'tool' => 'Fornecedores', 'route' => '/compra/fornecedor/'],
            
		];
    }

    public function index()
    {
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;


        return view('compra::orcamento.formulario', compact('moduleInfo','menu'));
    }

    public function create($id)
    {   
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'pedido'		=> Pedido::FindOrFail($id),
            "itens_pedido" => Pedido::findOrFail($id)->itens,
			'title'				=> "Itens Solicidados",
		]; 
        


        return view('compra::orcamento.formulario', compact('moduleInfo','menu'));
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        return view('compra::orcamento.show');
    }

    public function edit($id)
    {
        return view('compra::orcamento.edit');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
    
    }
}
