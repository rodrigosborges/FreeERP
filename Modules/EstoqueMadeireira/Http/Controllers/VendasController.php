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
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],


        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    
    
    
    
    //Tela inicial de Vendas, apresenta a lista dos Clientes
    public function index()
    {
        $flag = 0;
        $clientes = Cliente::paginate(5 );
        return view('estoquemadeireira::vendas.index', $this->template, compact('clientes', 'flag'));     
    }
 

    public function create()
    {           
      
    }


   

    public function store(Request $request)       
    {
        
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


    public function busca(Request $request){
        $sql = [];
        $clientes = Cliente::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/vendas')->with('error', 'Insira um dado para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
            
        
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
        if($request['flag'] == 1){
            $clientes = Cliente::onlyTrashed()->where($sql)->paginate(5);
            if(count($clientes) == 0){
                return redirect('/estoquemadeireira/vendas')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::vendas.index', $this->template, compact('clientes', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $clientes = Cliente::where($sql)->paginate(5);
            if(count($clientes) == 0){
                return redirect('/estoquemadeireira/vendas')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::vendas.index', $this->template, compact('clientes', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }

    }

}