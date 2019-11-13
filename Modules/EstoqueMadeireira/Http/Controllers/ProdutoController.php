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
use Modules\EstoqueMadeireira\Entities\UnidadeMedida;





class ProdutoController extends Controller
{

    //PRODUTOS DO SISTEMA: Entram no estoque e são vendidos (Vendas)
    
    //Propriedades: Nome OBRIGATÓRIO, 
    //Preço por unidade-> valor unitário do Produto OBRIGATÓRIO, 
    //Categoria-> categoria que pertence o produto OBRIGATÓRIO, 
    //Fornecedor-> quem fornece o produto OBRIGATÓRIO, 
    //Tamanho-> tamanho do produto se houver especificações, 
    //Unidade de Medida-> como o produto está sendo medido (ex: m², m³, ),  *INICIE A SEED PARA TER AS OPÇÕES PRÉ DEFINIDAS*
    //Descrição-> comentários, se houver, do produto

    //A função construct carrega as informações do template padrão do sistema, passado no $this->template



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


    //Inicio da sessão Produtos, onde é apresentado 5 produtos por páginas com as 
    //propriedades: Nome, Categoria, Preço, Fornecedor e as opções de Editar e Visualizar a ficha do produto requisitado
    //A variável flag serve para carregar os ativos e os inativos na mesma view, onde 
    //Flag = 0: ATIVOS ; Flag = 1: INATIVOS
    
    public function index()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $produtos = Produto::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Produtos/index', $this->template, compact('categorias', 'fornecedores', 'produtos', 'flag'));
    }

    //Retorna a index com os inativos no sistema, sendo possível reativa-los na função restore

    public function inativos()
    {
        $produtos = Produto::onlyTrashed()->paginate(5);
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $flag = 1;

        return view('estoquemadeireira::Produtos/index', $this->template, compact('produtos', 'categorias', 'flag', 'fornecedores'));
    }

    //Retorna o formulário para a criação de um novo produto

    public function create()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $unidadeMedidas = UnidadeMedida::all();
        
        return view('estoquemadeireira::produtos/form', $this->template, compact('categorias', 'fornecedores', 'unidadeMedidas'));     
    }

    //Insere o produto no banco, já validando se as informações estão corretas (Request)

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

    //Reativa o Produto requisitado (id)

    public function restore($id){
       
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();

        return redirect('estoquemadeireira/produtos')->with('success', 'Produto restaurado com sucesso!');

    }

    //Retorna o formulário de criação já preenchido com as informações do id do Produto requisitado (função update)

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $unidadeMedidas = UnidadeMedida::all();

     
        return view('estoquemadeireira::produtos.form', $this->template, compact('produto', 'categorias', 'fornecedores','unidadeMedidas'));
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
  
    


    //Retorna a ficha do Produto

    public function ficha($id){
        $produto = Produto::findOrFail($id);
        $unidadeMedida = UnidadeMedida::findOrFail($produto->unidadeMedida_id);
        
        return view('estoquemadeireira::produtos/ficha', $this->template, compact('produto', 'unidadeMedida'));

    }


    //Desativa o produto que tiver o ID passado

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect('/estoquemadeireira/produtos')->with('success', 'Produto desativado com sucesso!');
    }

    //Função de busca do Produto, filtra pelo: Nome, Categoria, Preço mínimo e máximo
    
    public function busca(PesquisaProdutoRequest $request){
    
        //a variavel sql vai carregar a query de consulta ao banco

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
        
        //Flag = 0 (index de ativos) retorna os produtos ativos
        //Flag = 1 (index de inativos) retorna os produtos inativos(onlyTrashed)
        
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
