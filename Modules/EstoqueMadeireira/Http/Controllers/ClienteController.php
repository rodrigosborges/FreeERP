<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Cliente;
use Modules\EstoqueMadeireira\Entities\Documento;
use Modules\EstoqueMadeireira\Entities\Endereco;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class ClienteController extends Controller
{


    public $template;

    public function __construct(){
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
            ['icon' => 'class', 'tool' => 'Categorias', 'route' => '/estoquemadeireira/produtos/categorias'],
            ['icon' => 'account_circle', 'tool' => 'Fornecedores', 'route' => '/estoquemadeireira/produtos/fornecedores'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],

        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }



    public function index()
    {
        $clientes = Cliente::paginate(5);
        $flag = 0;
        
        return view('estoquemadeireira::vendas.cliente.index', $this->template, compact('clientes', 'flag'));
    }

    public function inativos()
    {
        $clientes = Cliente::onlyTrashed()->paginate(5);
        $flag = 1;

        return view('estoquemadeireira::vendas.cliente.index', $this->template, compact('clientes', 'flag',));
    }



    public function create()
    {         
         
        $data = [
            'button' => 'cadastrar',
            'url' =>'estoquemadeireira/vendas/clientes',
            'cliente' => null,
            'endereco' => null,
            
        ];
        
        
        return view('estoquemadeireira::vendas.cliente.form', $this->template, compact('data'));
        
    }


    public function store(Request $req)
    {
        DB::beginTransaction();
        try{
           $cliente = Cliente::create($req->all());
           $teste = Endereco::create([
                'cliente_id' => $cliente->id,
                'endereco' => $req->endereco,
                'complemento' => $req->complemento,
            ]);
            DB::commit();
            return redirect('/estoquemadeireira/vendas/clientes')->with('Success', 'Cliente cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Cliente');
        }
    }

    public function edit($id)
    {
       
       
        $cliente = Cliente::findOrFail($id);      
        return view('estoquemadeireira::vendas.cliente.form', $this->template, compact('cliente'));
    }


     public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/vendas/clientes')->with('success', 'Cliente atualizado com sucesso!');
      
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }


    public function destroy($id)
    {
        $cliente = cliente::findOrFail($id);
        $cliente->delete();
        return redirect('/estoquemadeireira/vendas/clientes')->with('success', 'Cliente desativado com sucesso!');
    }

    public function restore($id)
    {
        $cliente = Cliente::onlyTrashed()->findOrFail($id);
        $cliente->restore();
        return redirect('/estoquemadeireira/vendas/clientes')->with('success', 'Cliente reativado com sucesso!');
    }

    public function ficha($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('estoquemadeireira::vendas.cliente.ficha', $this->template, compact('cliente'));
    }


    public function busca(Request $request){
        $sql = [];
        $clientes = Cliente::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/vendas/clientes')->with('error', 'Insira um dado para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
        if($request['flag'] == 1){
            $clientes = Cliente::onlyTrashed()->where($sql)->paginate(5);
            if(count($clientes) == 0){
                return redirect('/estoquemadeireira/vendas/clientes')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::vendas.cliente.index', $this->template, compact('clientes', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $clientes = Cliente::where($sql)->paginate(5);
            if(count($clientes) == 0){
                return redirect('/estoquemadeireira/vendas/clientes')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::vendas.cliente.index', $this->template, compact('clientes', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }

    }
}


