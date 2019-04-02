<?php


namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Compra\Entities\{Pedido,ItemCompra};


class PedidoController extends Controller
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
			'pedido'		=> Pedido::all(),
			'title'				=> "Lista de Pedidos",
		]; 
			
	    return view('compra::pedido', compact('data','moduleInfo','menu'));
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
			"url" 	 	=> url('compra/pedido'),
			"button" 	=> "Salvar",
            "model"		=> null,
            "itens"		=> ItemCompra::all(),
			'title'		=> "Cadastrar Pedido"
		];
	    return view('compra::formulario_pedido', compact('data','moduleInfo','menu'));

    }

    
    public function store(Request $request)
    {
        DB::beginTransaction();
		try{
            $pedido = Pedido::Create(['status' => 'iniciado']);
            $pedido->itens()->sync($request->itens);
            DB::commit();
            return redirect('/compra/pedido')->with('success', 'Pedido cadastrado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

   
    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
	    return view('compra::show', [
            'model' => $pedido	    
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
			"url" 	 	=> url("compra/pedido/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Pedido::findOrFail($id),
			'title'		=> "Atualizar Pedido"
		];
	    return view('compra::pedido', compact('data','moduleInfo','menu'));
    }

    
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
			$pedido = Pedido::findOrFail($id);
			$pedido->update($request->all());
			DB::commit();
			return redirect('compra/pedido')->with('success', 'Pedido atualizado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

  
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
		$pedido->delete();
		return back()->with('success',  'Item deletado');  
    }
}
