<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Entities\{Relacao,Endereco, Email, Telefone, TipoTelefone, Cidade, Estado};
use Modules\Compra\Entities\{Fornecedor};
use Modules\Compra\Http\Requests\CreateFornecedor;



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
            'model'             => '',
			'fornecedor'		=> Fornecedor::all(),
            'title'				=> "Lista de Funcionários",
            'telefones'         => [new Telefone],
            'tipos_telefone'    => TipoTelefone::all(),
            'estados'           => Estado::all(),
            'cidades'           => Cidade::all(),
		]; 
			
	    return view('compra::fornecedor.fornecedor', compact('data','moduleInfo','menu'));
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
	    return view('compra::fornecedor.formulario_fornecedor', compact('data','moduleInfo','menu'));

    }

    public function store(Request $request)
    {
		DB::beginTransaction();
		try{

            


            $fornecedor = Fornecedor::Create($request->fornecedor);
            $endereco = Endereco::Create($request->endereco);
            $telefone = Telefone::Create($request->telefone);
            $email = Email::Create($request->email);

            Relacao::create([
                'tabela_origem'     => 'fornecedor',
                'origem_id'         => $fornecedor->id,
                'tabela_destino'    => 'endereco',
                'destino_id'        => $endereco->id,
                'modelo'            => 'Endereco'
            ]);
            
            Relacao::create([
                'tabela_origem'     => 'fornecedor',
                'origem_id'         => $fornecedor->id,
                'tabela_destino'    => 'email',
                'destino_id'        => $email->id,
                'modelo'            => 'Email'
            ]);

            Relacao::create([
                'tabela_origem'     => 'fornecedor',
                'origem_id'         => $fornecedor->id,
                'tabela_destino'    => 'telefone',
                'destino_id'        => $telefone->id,
                'modelo'            => 'Telefone'
            ]);



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
	    return view('compra::fornecedor.formulario_fornecedor', compact('data','moduleInfo','menu'));
        
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
