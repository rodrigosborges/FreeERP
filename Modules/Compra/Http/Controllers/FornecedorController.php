<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Compra\Entities\{Fornecedor};

class FornecedorController extends Controller
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
            ['icon' => 'search', 'tool' => 'Busca', 'route' => '#'],
		];
    }


    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
			'fornecedor'		=> Fornecedor::all(),
			'title'				=> "Lista de Funcionários",
		]; 
			
	    return view('compra::fornecedor', compact('data','moduleInfo','menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
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
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
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
        $fornecedor = Fornecedor::findOrFail($id);
		$fornecedor->delete();
		return back()->with('success',  'Fornecedor deletado');    
        
    }
}
