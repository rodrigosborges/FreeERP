<?php


namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Compra\Entities\{Pedido,ItemCompra,Fornecedor};


class PedidoController extends Controller
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
            ['icon' => 'library_books', 'tool' => 'Pedidos', 'route' => '/'],
            ['icon' => 'local_shipping', 'tool' => 'Fornecedores', 'route' => '/compra/fornecedor/'],
            ['icon' => 'search', 'tool' => 'Busca', 'route' => '#'],
		];
    }
    
    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
			'pedido'		=> Pedido::all(),
			'title'				=> "Lista de Pedidos",
		]; 
			
	    return view('compra::pedido', compact('data','moduleInfo','menu'));
    }


    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        
        $data = [
			"url" 	 	=> url('compra/pedido'),
			"button" 	=> "Salvar",
            "pedido"		=> null,
            "itens"		=> ItemCompra::all(),
            "itens_pedido"  => [['id' => "",'quantidade'=>""]],
            'title'		=> "Cadastrar Pedido"
            
		];
	    return view('compra::formulario_pedido', compact('data','moduleInfo','menu'));


    }

    
    public function store(Request $request)
    {       
        DB::beginTransaction();
		try{
            $pedido = Pedido::Create(['status' => 'iniciado']);
            
            $pedido->itens()->attach($request->itens);
    
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
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        
        $data = [
			"url" 	 	=> url("compra/pedido/$id"),
			"button" 	=> "Atualizar",
            "pedido"	=> Pedido::findOrFail($id),
            "itens"		=> ItemCompra::all(),
            "itens_pedido" => Pedido::findOrFail($id)->itens,
			'title'		=> "Atualizar Pedido"
		];
	    return view('compra::formulario_pedido', compact('data','moduleInfo','menu'));
    }

    
    public function update(Request $request, $id)
    {
        
        DB::beginTransaction();
		try{
            $pedido = Pedido::findOrFail($id);
            if($pedido->status =='iniciado'){
                
                return redirect('compra/pedido')->with('success', 'Pedido atualizado com successo');
            }
            else
            {
                return back()->with('warning',  'Pedido não pode ser alterado');
            }

		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

  
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        if($pedido->status =='iniciado')
        {
            $pedido->delete();
            return back()->with('success',  'Pedido deletado');
        }
        else
        {
            return back()->with('warning',  'Pedido não pode ser deletado');
        }  
    }

    public function pedidos_disponiveis()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        
        $data = [
			'pedido'		=> Pedido::all(),
			'title'		=> "Lista de Pedidos Disponíveis",
		]; 
        return view('compra::pedidos_disponiveis', compact('data','moduleInfo','menu'));
    }

    public function enviar_email(Request $request){
        Mail::send('teste', ['curso'=>'Eloquent'], function($m){
            $m->from('thofurtado@gmail.com', 'Modulo Compras');
            $m->to('pedrops02@gmail.com');
        });
    }

    public function gerar_orcamento($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        
        $data = [
            'url'   => url("compra/pedido/$id"),
            'pedido'	=> Pedido::findOrFail($id),
            'fornecedores'=> Fornecedor::all(),
            'itens_pedido' => Pedido::findOrFail($id)->itens()->get(),
			'title'		=> "Lista de Pedidos Disponíveis",
		]; 
        return view('compra::gerar_orcamento', compact('data','moduleInfo','menu'));
    } 

}
