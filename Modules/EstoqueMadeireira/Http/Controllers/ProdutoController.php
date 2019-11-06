<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\EstoqueMadeireira\Http\Requests\ProdutoRequest;
use Modules\EstoqueMadeireira\Http\Requests\PesquisaProdutoRequest;
use Modules\EstoqueMadeireira\Entities\Produto;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Entities\Fornecedor;




class ProdutoController extends Controller
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


    public function index()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $produtos = Produto::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Produtos/index', $this->template, compact('categorias', 'fornecedores', 'produtos', 'flag'));
    }

    public function inativos()
    {
        $produtos = Produto::onlyTrashed()->paginate(5);
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $flag = 1;

        return view('estoquemadeireira::Produtos/index', $this->template, compact('produtos', 'categorias', 'flag', 'fornecedores'));
    }

    public function restore($id){
       
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();

        return redirect('estoquemadeireira/produtos')->with('success', 'Produto restaurado com sucesso!');

    }

    public function create()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        
        
        return view('estoquemadeireira::produtos/form', $this->template, compact('categorias', 'fornecedores'));

        
    }


    public function store(ProdutoRequest $req)
    {
       
        DB::beginTransaction();
        try{
            Produto::create($req->all());
            DB::commit();

            return redirect('/estoquemadeireira/produtos')->with('Success', 'Produto cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Produto');
        }
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
     
        return view('estoquemadeireira::produtos.form', $this->template, compact('produto', 'categorias', 'fornecedores'));
    }
    
    public function update(ProdutoRequest $req, $id)
    {
        DB::beginTransaction();
        try {
            $produto = Produto::findOrFail($id);
            $produto->update($req->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos')->with('success', 'Produto atualizado com sucesso');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }
  
    



    public function ficha($id){
        $produto = Produto::findOrFail($id);

        return view('estoquemadeireira::produtos/ficha', $this->template, compact('produto'));

    }


    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect('/estoquemadeireira/produtos')->with('success', 'Produto desativado com sucesso!');
    }

    public function busca(PesquisaProdutoRequest $request){
    
        
        $sql = [];
        $categorias = Categoria::all();
        
        if($request['pesquisa'] == null){
            if($request['precoMin'  ] == null){
                return redirect('/estoquemadeireira/produtos')->with('error', 'Insira algum dado para a pesquisa');
            }
            return redirect('/estoquemadeireira/produtos')->with('error', 'Insira algum dado para a pesquisa');
        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        }
        if($request['categoria_id'] != -1){
            array_push($sql, ['categoria_id', '=', $request['categoria_id']]);
        }else{
        }
        if($request['precoMin'] != null){
            if($request['precoMax'] != null){
                array_push($sql, ['preco', '>=', $request['precoMin']]);
                array_push($sql, ['preco', '<=', $request['precoMax']]);
            }else{
                array_push($sql, ['preco', '>=', $request['precoMin']]);
            }
        }else if($request['precoMax'] != null){
                array_push($sql, ['preco', '<=', $request['precoMax']]);
        }
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
        if($request['flag'] == 1){
            $produtos = Produto::onlyTrashed()->where($sql)->paginate(5);
            if(count($produtos) == 0){
                return redirect('/estoquemadeireira/produtos')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::produto.index', $this->template, compact('produtos', 'categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $produtos = Produto::where($sql)->paginate(5);
            if(count($produtos) == 0){
                return redirect('/estoquemadeireira/produtos')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::produtos.index', $this->template, compact('produtos', 'categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }
    

}
