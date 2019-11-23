<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\{Produto, Pedido, Estoque, Cliente, itemPedido};
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
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],

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
      $cliente = Cliente::all();
      $pedidos = itemPedido::all();
      $pedidos = DB::table('pedidos')
        ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
        ->join('item_pedidos', 'item_pedidos.pedido_id', '=', 'pedidos.id')->paginate(10);

       return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos'));
    }

    //Retorna os inativos, com a opção de reativa-los 

    
    public function abertos()
    {
        $cliente = Cliente::all();
        $pedidos = itemPedido::all();
        $pedidos = DB::table('pedidos')
          ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
          ->join('item_pedidos', 'item_pedidos.pedido_id', '=', 'pedidos.id')->paginate(10);
        
         return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos'));
    }


    public function enviados()
    {
        $itemPedido = itemPedido::all();
        $pedidos = Pedido::where('status_pedido', 2)->paginate(10);
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'itemPedido'));
    }
    
    public function finalizados()
    {
        $itemPedido = itemPedido::all();
        $pedidos = Pedido::where('status_pedido', 3)->paginate(10);
        return view('estoquemadeireira::vendas.pedidos.index', $this->template, compact('pedidos', 'itemPedido'));
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

       
        $pedido = Pedido::findOrFail($id);      
        return view('estoquemadeireira::vendas.pedidos.form', $this->template, compact('pedido'));
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


    //Função para encontrar um pedido registrado filtrando pelo ID


    public function busca(Request $request){
        
        if($request->pesquisa == null){
            $pedidos = Pedido::paginate(10);
            return redirect('/estoquemadeireira/vendas/pedidos')->with('error', 'Insira um ID para a pesquisa!');
        }
        else{      
            $pedidos = Pedido::where('id', $request->pesquisa)->paginate(10);
            if(count($pedidos) > 0){
                return view('estoquemadeireira::vendas.pedidos.index')->with('success', 'Resultado da pesquisa');
            }else{
                return redirect('/estoquemadeireira/vendas/pedidos')->with('error', 'Nenhum resultado encontrado');
            }
        }
    }

    public function ficha($id){
       $pedidos = DB::table('pedidos')
          ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
          ->join('item_pedidos', 'item_pedidos.pedido_id', '=', 'pedidos.id')->get();
       return $pedidos;
          return view('estoquemadeireira::vendas.pedidos.ficha', $this->template, compact('pedidos'));
    }


    //Funções do AJAX: 
    //BUSCA CLIENTE;
    //BUSCA PRODUTO;

    public function buscaCliente(Request $request){
        if($request->valor != null)
            $query = Cliente::where('nome','like', $request->valor.'%')->get();
        else
            $query = [];
        return $query;
    }

    public function buscaProduto(Request $request){
        // $estoque = Estoque::produtos()->where('id' ,'>', 0);
        // return $estoque;
        if($request->valor != null)
            $query = DB::table('estoque')
            ->join('estoque_has_produto', 'estoque_has_produto.estoque_id', '=', 'estoque.id')
            ->join('produto', 'produto.id', '=', 'estoque_has_produto.produto_id') 
            ->where('produto.nome', 'like', '%' . $request->valor. '%')->get();
        else
            $query = [];
       
        return $query;  
    }

    public function verificaEstoque(Request $request){
        $query = [];

        if($request->valor != null){
            $query = Estoque::where($request->valor,'>','quantidade');
        }
        else{
            $query;
        }
        return $query;
    }

    public function gerarpedido(Request $request){
        DB::beginTransaction();

         $pedido = Pedido::create([
             'cliente_id' => $request->cliente,
             'taxa' => '0.00',
             'desconto' => '0.00',
             'status_pedido' => 1
         ]);
       
         try{
            for($i=0; $i < count($request->produtos) ; $i+=3){
                ItemPedido::create([
                    'pedido_id' => $pedido['id'],
                    'produto_id' => $request->produtos[$i]['id'],
                    'quantidade' => $request->produtos[$i]['quantidade'],
                    'precoVenda' => $request->produtos[$i]['preco'],
                    'precoCusto' => '0.00'
                    
                ]);
            }
            DB::commit();
            return redirect('/estoquemadeireira/vendas/pedidos')->with('success', 'Pedido registrado com sucesso!');
         }catch(\Exception $e){
             return $e;
             return back()->with('Error', 'Erro no cadastro de pedido');

         }
        
     return redirect('/estoquemadeireira/vendas/pedidos')->with('success', 'Pedido registrado com sucesso!');


    }
}
