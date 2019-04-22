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
			
	    return view('compra::fornecedor', compact('data','moduleInfo','menu'));
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
			"url" 	 	=> url('compra/fornecedor'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Fornecedor"
		];
	    return view('compra::formulario_fornecedor', compact('data','moduleInfo','menu'));

    }

    public function store(Request $request)
    {
		DB::beginTransaction();
		try{
			$fornecedor = Fornecedor::Create($request->all());
			DB::commit();
			return redirect('/compra/fornecedor')->with('success', 'Fornecedor cadastrado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    
    public function show($id)
    {
        $itemCompra = Fornecedor::findOrFail($id);
	    return view('compra::show', [
            'model' => $fornecedor	    
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
			"url" 	 	=> url("compra/fornecedor/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Fornecedor::findOrFail($id),
			'title'		=> "Atualizar Fornecedor"
		];
	    return view('compra::formulario_fornecedor', compact('data','moduleInfo','menu'));
        
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
			$fornecedor = Fornecedor::findOrFail($id);
			$fornecedor->update($request->all());
			DB::commit();
			return redirect('compra/fornecedor')->with('success', 'Fornecedor atualizado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
        
    }

    public function destroy($id)
    {
        $itemCompra = Fornecedor::findOrFail($id);
		$itemCompra->delete();
		return back()->with('success',  'Fornecedor deletado');    
        
    }
}
