<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Compra\Entities\{Fornecedor};

class FornecedorController extends Controller
{

    public function index()
    {

        $moduleInfo = [
            'icon' => 'store',
            'name' => 'COMPRA',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
		];
        $data = [
			'fornecedor'		=> Fornecedor::all(),
			'title'				=> "Lista de Funcionários",
		]; 
			
	    return view('compra::item', compact('data','moduleInfo','menu'));
    }

    public function create()
    {
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'COMPRA',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
		];
        $data = [
			"url" 	 	=> url('compra/itemCompra'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Item Compra"
		];
	    return view('compra::formulario_item', compact('data','moduleInfo','menu'));

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
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'COMPRA',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
            
		];
        $data = [
			"url" 	 	=> url("compra/itemCompra/$id"),
			"button" 	=> "Atualizar",
			"model"		=> ItemCompra::findOrFail($id),
			'title'		=> "Atualizar Item Compra"
		];
	    return view('compra::formulario_item', compact('data','moduleInfo','menu'));
        
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
