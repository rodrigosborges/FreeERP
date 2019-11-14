<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\{Produto, Pedido, Estoque, Cliente};
use Modules\EstoqueMadeireira\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class PedidoController extends Controller
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
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],

        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }

    //Inicio da sessão Categorias, carrega 5 categorias registradas, com Nome, e os botões de Editar e Deletar
    //A variável flag serve para carregar os ativos e os inativos na mesma view, onde 
    //Flag = 0: ATIVOS ; Flag = 1: INATIVOS

    public function index()
    {
        $flag = 0;
        $pedidos = Pedido::paginate(10);        
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'flag'));
    }

    //Retorna os inativos, com a opção de reativa-los 

    
    public function abertos()
    {
        $flag = 1;
        $pedidos = Pedido::all()->paginate(10);
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'flag',));
    }


    public function enviados()
    {
        $flag = 2;
        $pedidos = Pedido::all()->paginate(10);
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'flag',));
    }
    
    public function finalizados()
    {
        $flag = 3;
        $pedidos = Pedido::all()->paginate(10);
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'flag',));
    }




    public function restore($id){
       
        $categoria = Categoria::onlyTrashed()->findOrFail($id);
        $categoria->restore();

        return redirect('estoquemadeireira/produtos/categorias')->with('success', 'Categoria restaurada com sucesso!');

    }

    //Insere a nova categoria no banco (store), verificando se já não existe um registro igual no banco

    public function create()
    {
        
        // $pedidos = Pedido::all();
        // $produtos = Produto::all();
        // $clientes = Cliente::all();
        $data = [
            'pedidos' => Pedido::all(),
            'produtos' => Produto::all(),
            'clientes' => Cliente::all()

        ];

        return view('estoquemadeireira::vendas.pedidos.form', $this->template, compact('data'));

        
    }



    public function store(CategoriaRequest $req)
    {
       
        DB::beginTransaction();
        try{
            Categoria::create($req->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos/categorias')->with('Success', 'Categoria cadastrada com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Categoria');
        }
    }

    //Retorna o formulário com a categoria passada para ser editada 

    public function edit($id)
    {

       
        $categoria = Categoria::findOrFail($id);      
        return view('estoquemadeireira::categoria.form', $this->template, compact('categoria'));
    }

    //Atualiza a Categoria

     public function update(CategoriaRequest $request, $id)
    {

        DB::beginTransaction();
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Categoria atualizada com sucesso!');
      
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    //Desativa a Categoria do sistema, sendo possível reativa-la depois

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Categoria desativada com sucesso!');
    }


    //Função para encontrar uma categoria registrada, filtrando pelo Nome

    public function busca(Request $request){
        $sql = [];
        $categorias = Categoria::all();
        
        return $request;
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        //Flag = 0 (index de ativos) retorna as categorias ativas
        //Flag = 1 (index de inativos) retorna as categorias inativas (onlyTrashed)
        
        if($request['flag'] == 1){
            $categorias = Categoria::onlyTrashed()->where($sql)->paginate(5);
            if(count($categorias) == 0){
                return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Categoria.index', $this->template, compact('categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $categorias = Categoria::where($sql)->paginate(5);
            if(count($categorias) == 0){
                return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Categoria.index', $this->template, compact('categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }

    }
    public function buscaCliente(Request $request){
        if($request->valor != null)
            $query = Cliente::where('nome','like', $request->valor.'%')->get();
        else
            $query = [];
        return $query;
    }
}