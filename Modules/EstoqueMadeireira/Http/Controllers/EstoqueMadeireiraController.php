<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Estoque;
use Modules\EstoqueMadeireira\Entities\tipoUnidade;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Entities\MovimentacaoEstoque;
use Modules\EstoqueMadeireira\Entities\Produto;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class EstoqueMadeireiraController extends Controller
{


    //ESTOQUE DE PRODUTOS: onde é salvo as informações do estoque do produto especifícado, aonde está localizado no estoque fisíco, preço de custo daquele estoque e a quantidade de itens do produto
    //Propriedades:
    //Produto: Nome do produto JÁ REGISTRADO, OBRIGATÓRIO.
    //Nome da Unidade: Especifica em que local fisíco está localizado aquele estoque do Produto X, exemplo: Parafusos na PRATELEIRA 3, OBRIGATÓRIO
    //Preço de Custo: Preço de custo total daquele estoque de produto que está entrando, serve para que se compare preços no futuro
    //Quantidade: A quantidade de produtos X que está entrando no estoque 


    //A função construct serve para passar o template padrão do sistema para serem carregadas na função, passadas pelo $this->template


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
    
    
    
    
    //Tela inicial do Estoque
    public function index()
    {
        $flag = 0;
        $itens = Estoque::paginate(5);
        return view('estoquemadeireira::estoque.index', $this->template, compact('itens', 'flag'));     
    }
 
    //Tela de estoques desativados

    public function inativos()
     {
        $flag = 1;
        $itensInativos = Estoque::onlyTrashed()->paginate(5);
        return view('estoquemadeireira::estoque.index', $this->template, compact('itensInativos', 'flag'));     


    }
    


    //Criação do estoque, usando 'data' para comprimir todos os dados em uma só variável, e passando as notificações pro template
    public function create()
    {           
        $data = [
            'titulo' => 'Cadastrar Estoque',
            'button' => 'Cadastrar',
            'url' => 'estoquemadeireira',
            'estoque' => null,
            'produtos' => Produto::all(),
            'tipoUnidade' => TipoUnidade::all()
        ];
            
        return view('estoquemadeireira::.estoque.form', $this->template, compact('data'));
    }


    //Função para salvar o Estoque no banco, carregando: Produto (nome), Unidade da localização do estoque, Preço de custo desse estoque e a quantidade de produtos que serão registrados
    //A primeira movimentação desse estoque já é registrada (MovimentacaoEstoque::create) 

    public function store(Request $request)
    {
        try{
            $estoque = Estoque::create($request->all());
            $produto = Produto::findOrFail($request->produto_id);
            $estoque->produtos()->attach($produto);
            $estoque->save();
            MovimentacaoEstoque::create(
                [
                    'estoque_id' => $estoque->id,
                    'quantidade' => $estoque->quantidade,
                    'preco_custo' => $request['preco_custo'],
                    'observacao' => "Entrada Inicial",
                ]
            );
            DB::commit();
            return redirect('/estoquemadeireira')->with('success', 'Item de estoque registrado com sucesso!');
        } 
        catch (Exception $e) {
            DB::rollback();
            return back()->with('Error', 'Erro no cadastro de Estoque');
        }
    }

    




    public function edit($id)
    {
        $estoque = Estoque::findOrFail($id);
        $idProduto = $estoque->produtos->last()->id;
        $data2 = array();
        $itens = DB::table('estoque')
            ->join('estoque_has_produto', function ($join) use ($idProduto) {
                $join->where('produto_id', $idProduto)->whereraw('estoque.id = estoque_has_produto.estoque_id');
            })->get();
        foreach ($itens as $item) {
            if ($item->tipo_unidade_id != $estoque->tipo_unidade_id) {
                $data2[] = $item->tipo_unidade_id;
            }
        }
        $data = [
            'button' => 'atualizar',
            'url' => 'estoquemadeireira/' . $id,
            'titulo' => 'Editar Estoque',
            'estoque' => $estoque,
            'produtos' => Produto::withTrashed()->get(),
            'produto' => $estoque->produtos->last(),
            'tipoUnidade' => TipoUnidade::all()->except($data2),
        ];
        return view('estoquemadeireira::estoque.form', compact('data'));

    }


    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }

    //NOTIFICAÇÕES POR ENQUANTO NÃO FEITO
    // public static function verificarNotificacao()
    // {
    //     $itens = Estoque::where('quantidade', '<=', DB::raw('quantidade_notificacao'))->paginate(10);
    //     return count($itens);
    // 

    public function Busca(Request $request){

        $flag = 0;
        
        if ($request['pesquisa'] == null) {
            
            return redirect('/estoquemadeireira')->with('Error', 'Insira um nome para a pesquisa');
        } else {
            $itens = Estoque::join('estoque_has_produto', 'estoque_has_produto.estoque_id', '=', 'estoque.id')
                ->join('produto', 'produto.id', '=', 'estoque_has_produto.produto_id')
                ->where('produto.nome', 'like', '%' . $request->pesquisa . '%')->paginate(5);
            return view('estoquemadeireira::estoque.index', $this->template, compact( 'itens', 'flag'))->with('success', 'Resultado da Pesquisa');
        }
    }


}
