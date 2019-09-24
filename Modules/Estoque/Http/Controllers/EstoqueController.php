<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\{Produto, Estoque, TipoUnidade, MovimentacaoEstoque};
use DB;

class EstoqueController extends Controller
{
    public $dadosTemplate;

    public function __construct()
    {
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'Estoque',
        ];
        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
            ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('/estoque/produto/categoria')],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
        ];
        $this->dadosTemplate = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu,
        ];
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $flag = 0;
        $notificacoes = $this->verificarNotificacoes();
        $itens = Estoque::paginate(10);
        return view('estoque::estoque.index', $this->dadosTemplate, compact('itens', 'flag', 'notificacoes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $notificacoes = $this->verificarNotificacoes();
        $data = [
            'titulo'  => 'Cadastrar Estoque',
            'button'  => 'Cadastrar',
            'url'     => 'estoque',
            'estoque' => null,
            'produtos' => Produto::all(),
            'tipoUnidade' => TipoUnidade::all(),
        ];

        return view('estoque::estoque.form', compact('data', 'notificacoes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //   dd($request->all());

        //return $unidades;
       
 
        DB::beginTransaction();
        try {

            $estoque = Estoque::create($request->all());
            $produto = Produto::findOrFail($request->produto_id);
            $estoque->produtos()->attach($produto);
            $estoque->save();
            MovimentacaoEstoque::create(
                [
                    'estoque_id' => $estoque->id,
                    'quantidade' => $estoque->quantidade,
                    'preco_custo' => $request['preco_custo'],
                    'observacao' => "Entrada Inicial"
                ]
            );
            DB::commit();
            return redirect('/estoque')->with('success', 'Item de estoque registrado com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return back()->with('danger', "Erro ao tentar registrar item. cod:" + $ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('estoque::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        
        $notificacoes = $this->verificarNotificacoes();
        $estoque = Estoque::findOrFail($id);
        $idProduto = $estoque->produtos->last()->id;
        $data2 = array();
        $itens = DB::table('estoque')
            ->join('estoque_has_produto', function ($join) use ($idProduto) {
                $join->where('produto_id', $idProduto)->whereraw('estoque.id = estoque_has_produto.estoque_id');
            })->get();          
        foreach ($itens as $item)
            if ($item->tipo_unidade_id != $estoque->tipo_unidade_id)
                $data2[] = $item->tipo_unidade_id;
        $data = [
            'button' => 'atualizar',
            'url' => 'estoque/' . $id,
            'titulo' => 'Editar Estoque',
            'estoque' => $estoque,
            'produtos' => Produto::withTrashed()->get(),
            'produto' => $estoque->produtos->last(),
            'tipoUnidade' => TipoUnidade::all()->except($data2),

        ];
        return view('estoque::estoque.form', compact('data', 'notificacoes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $estoque = Estoque::findOrFail($id);
            $observacao = $this->verificaAlteracoes($request, $estoque);
            $qtdInicial = $estoque->quantidade;
            $qtdMovimentacao =  $request['quantidade'] - $qtdInicial;
            $estoque->update($request->all());
            MovimentacaoEstoque::create(
                [
                    'estoque_id' => $estoque->id,
                    'quantidade' =>  $qtdMovimentacao,
                    'preco_custo' => $request['preco_custo'],
                    'observacao' => $observacao
                ]
            );
            DB::commit();
            return redirect('/estoque')->with('message', 'Item de estoque atualizado com sucesso')->with('success', 'Item de estoque atualizado com sucesso');
        } catch (Exception $ex) {
            DB::rollback();
            return back()->with('warning', ' Erro ao atualizar item de estoque! cod:' . $ex);
        }
    }
    public function buscaUnidades(Request $request)
    {
        $data2 = array();
        $itens = DB::table('estoque')
            ->join('estoque_has_produto', function ($join) use ($request) {
                $join->where('produto_id', $request->id)->whereraw('estoque.id = estoque_has_produto.estoque_id');
            })->get();
        foreach ($itens as $unidade)
            $data2[] = $unidade->tipo_unidade_id;
        $unidades = TipoUnidade::all()->except($data2);
        return json_encode($unidades);
    }
    public function verificaAlteracoes($request, $estoque)
    {
        $observacao = "Este item foi atualizado \n";
        if ($request->produto_id != $estoque->produtos->last()->id) {
            $produto = Produto::findOrFail($request->produto_id);
            $observacao .= "\n Alteração de produto de " . $estoque->produtos->last()->nome . " para " . $produto->nome;
            $estoque->produtos()->detach($estoque->produtos->last());
            $estoque->produtos()->attach($produto);
        }
        if (intval($request->tipo_unidade_id) != $estoque->tipo_unidade_id) {
            return  "Request unidade id =" . intval($request->tipo_unidade_id) . "Produto Unidade id = " . $produto->unidade_id;
            $novaUnidade = TipoUnidade::find($request->tipo_unidade_id);

            $observacao  .= "\n Alteração do tipo de unidade de " . $estoque->tipoUnidade->nome . " para " . $novaUnidade->nome;
        }
        if (floatVal($request->preco_custo) != floatVal($estoque->movimentacaoEstoque->last()->preco_custo)) {
            $observacao .= "\n . Alteração no preço de custo de " . $estoque->movimentacaoEstoque->last()->preco_custo . " para " . $request->preco_custo;
        }
        if ($request->quantidade != $estoque->quantidade) {
            $observacao .= " Quantidade alterada de " . $estoque->quantidade . " para " . $request->quantidade;
        }
        return $observacao;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);



        MovimentacaoEstoque::create(
            [
                'estoque_id' => $estoque->id,
                'quantidade' => $estoque->quantidade,
                'preco_custo' => $estoque->preco_custo,
                'observacao' => "Item Excluido"
            ]
        );
        $estoque->delete();
        return back()->with('success', 'Categoria Removida com sucesso');
        //
    }
    public function restore($id)
    {
        $estoque = Estoque::onlyTrashed()->findOrFail($id);
        $estoque->restore();
        return redirect('/estoque')->with('success', 'Item restaurado com sucesso!');
    }
    public function inativos()
    {
        $flag = 1;
        $itensInativos = Estoque::onlyTrashed()->paginate(5);
        $notificacoes = $this->verificarNotificacoes();
        return view('estoque::estoque.index', $this->dadosTemplate, compact('notificacoes', 'itensInativos', 'flag'));
    }

    public function buscar(Request $request)
    {
        $flag = 0;
        $notificacoes = $this->verificarNotificacoes();
        if ($request->pesquisa == null) {
            $itens = Estoque::paginate(10);
            return view('estoque::estoque.index', $this->dadosTemplate, compact('itens', 'flag'))->with('success', 'Resultado da Pesquisa');
        } else {
            $itens = Estoque::join('estoque_has_produto', 'estoque_has_produto.estoque_id', '=', 'estoque.id')
                ->join('produto', 'produto.id', '=', 'estoque_has_produto.produto_id')
                ->where('produto.nome', 'like', '%' . $request->pesquisa . '%')->paginate(10);
            return view('estoque::estoque.index', $this->dadosTemplate, compact('notificacoes', 'itens', 'flag'))->with('success', 'Resultado da Pesquisa');
        }
    }

    public function notificacoes()
    {
        $itens = Estoque::where('quantidade', '<=', DB::raw('quantidade_notificacao'))->paginate(10);
        $notificacoes = $this->verificarNotificacoes();
        return view('estoque::estoque.notificacoes.index', compact('itens', 'notificacoes'));
    }

    public static function verificarNotificacoes()
    {
        $itens = Estoque::where('quantidade', '<=', DB::raw('quantidade_notificacao'))->paginate(10);
        return count($itens);
    }
}
