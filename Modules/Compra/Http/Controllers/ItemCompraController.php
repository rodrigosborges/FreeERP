<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Compra\Entities\{ItemCompra};

class ItemCompraController extends Controller
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

        $data = [
			'item_compra'		=> ItemCompra::all(),
			'title'				=> "Lista de Itens",
		]; 
			
	    return view('compra::itemCompra.item', compact('data','moduleInfo','menu'));
    }

    public function create()
    {
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
			"url" 	 	=> url('compra/itemCompra'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Item Compra"
		];
	    return view('compra::itemCompra.formulario_item', compact('data','moduleInfo','menu'));

    }

    public function store(Request $request)
    {
		DB::beginTransaction();
		try{
			$itemCompra = ItemCompra::Create($request->all());
			DB::commit();
			return redirect('/compra/itemCompra')->with('success', 'Item cadastrado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    
    public function show($id)
    {
        $itemCompra = ItemCompra::findOrFail($id);
	    return view('compra::show', [
            'model' => $itemCompra	    
        ]);
    
    }

    public function edit($id)
    {   
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
			"url" 	 	=> url("compra/itemCompra/$id"),
			"button" 	=> "Atualizar",
			"model"		=> ItemCompra::findOrFail($id),
			'title'		=> "Atualizar Item Compra"
		];
	    return view('compra::itemCompra.formulario_item', compact('data','moduleInfo','menu'));
        
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
			$itemCompra = ItemCompra::findOrFail($id);
			$itemCompra->update($request->all());
			DB::commit();
			return redirect('compra/itemCompra')->with('success', 'Item atualizado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
        
    }

    public function destroy($id)
    {
        $itemCompra = ItemCompra::findOrFail($id);
		$itemCompra->delete();
		return back()->with('success',  'Item deletado');    
        
    }
}
