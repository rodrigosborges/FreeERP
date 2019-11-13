<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Estoque;
use Modules\EstoqueMadeireira\Entities\tipoUnidade;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Entities\MovimentacaoEstoque;
use Modules\EstoqueMadeireira\Entities\Produto;
use Modules\EstoqueMadeireira\Entities\{Cliente};



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class VendasController extends Controller
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
        $clientes = Cliente::paginate(5 );
        return view('estoquemadeireira::vendas.index', $this->template, compact('clientes', 'flag'));     
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

    

    public function edit(Request $id)
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

    //Atualiza o estoque selecionado, já atualiza a movimentação também

    public function update(Request $request, $id)
    {
     
        DB::beginTransaction();
        try {
            $estoque = Estoque::findOrFail($id);
            $observacao = $this->verificaAlteracoes($request, $estoque);
            $qtdInicial = $estoque->quantidade;
            $qtdMovimentacao = $request['quantidade'] - $qtdInicial;
            $estoque->update($request->all());
            MovimentacaoEstoque::create(
                [
                    'estoque_id' => $estoque->id,
                    'quantidade' => $qtdMovimentacao,
                    'preco_custo' => $request['preco_custo'],
                    'observacao' => $observacao,
                ]
            );
            DB::commit();
            return redirect('/estoque')->with('message', 'Item de estoque atualizado com sucesso')->with('success', 'Item de estoque atualizado com sucesso');
        } catch (Exception $ex) {
            DB::rollback();
            return back()->with('warning', ' Erro ao atualizar item de estoque! cod:' . $ex);
        }
    }
    

    public function verificaAlteracoes($request, $estoque)
    {
        $observacao = "Este item foi atualizado \n";
        if (intval($request->tipo_unidade_id) != $estoque->tipo_unidade_id) {
            // return "Request unidade id =" . intval($request->tipo_unidade_id) . "Produto Unidade id = " . $produto->unidade_id;
            $novaUnidade = TipoUnidade::find($request->tipo_unidade_id);
            $observacao .= "\n Alteração do tipo de unidade de " . $estoque->tipoUnidade->nome . " para " . $novaUnidade->nome;
        }
        if (floatVal($request->preco_custo) != floatVal($estoque->movimentacaoEstoque->last()->preco_custo)) {
            $observacao .= "\n . Alteração no preço de custo de " . $estoque->movimentacaoEstoque->last()->preco_custo . " para " . $request->preco_custo;
        }
        if ($request->quantidade != $estoque->quantidade) {
            $observacao .= " Quantidade alterada de " . $estoque->quantidade . " para " . $request->quantidade;
        }
        return $observacao;
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $movimentacao = MovimentacaoEstoque::where('observacao', 'Item Excluido')->where('estoque_id', $id)->get();
        $tamanho = count($movimentacao);
        if($movimentacao < 1){
            MovimentacaoEstoque::create([
                'estoque_id' => $estoque->id,
                'quantidade' => $estoque->quantidade,
                'preco_custo' => $estoque->movimentacaoEstoque->first()->preco_custo,
                'observacao'
            ]);
            $estoque->delete();
            return back()->with('success', 'Categoria Removida com sucesso');
        }
    }


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