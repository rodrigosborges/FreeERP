<?php

namespace Modules\Estoque\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\Categoria;
use Modules\Estoque\Entities\Estoque;
use Modules\Estoque\Entities\MovimentacaoEstoque;
use Modules\Estoque\Entities\Produto;

use Modules\Estoque\Entities\TipoUnidade;
use Barryvdh\DomPDF\Facade as PDF;
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
            'titulo' => 'Cadastrar Estoque',
            'button' => 'Cadastrar',
            'url' => 'estoque',
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
                    'observacao' => "Entrada Inicial",
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
        foreach ($itens as $item) {
            if ($item->tipo_unidade_id != $estoque->tipo_unidade_id) {
                $data2[] = $item->tipo_unidade_id;
            }
        }

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

    public function pdf(Request $request) {
        $data = $this->relatorioCustoResult($request->data_inicial, $request->data_final, $request->estoque_id);
        //return $data;
        $pdf = PDF::loadView('estoque::estoque.relatorios.pdf', compact('data'));
        return $pdf->stream();

        /*$data = [
            'estoque_id' => $estoque_id,
            'maior_custo' => $maior_preco,
            'custo_medio' => round($total / $quantidade_movimentada[0]->qtd, 2),
            'custo_total' => $total,
            'quantidade_movimentada' => $quantidade_movimentada[0]->qtd,
            'estoque' => Estoque::all(),
            'estoque_selecionado' => $estoque_selecionado,
            'labels' => json_encode($labels),
            'dados' => json_encode($dados),
            'flag' => "1",
            'movimentacao' => $movimentacao,
            'data_inicial' => $data_inicial,
            'data_final' => $data_final
        ];*/
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
    public function buscaUnidades(Request $request)
    {
        $data2 = array();
        $itens = DB::table('estoque')
            ->join('estoque_has_produto', function ($join) use ($request) {
                $join->where('produto_id', $request->id)->whereraw('estoque.id = estoque_has_produto.estoque_id');
            })->get();
        foreach ($itens as $unidade) {
            $data2[] = $unidade->tipo_unidade_id;
        }

        $unidades = TipoUnidade::all()->except($data2);
        return json_encode($unidades);
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $estoque = Estoque::findOrFail($id);
        $teste = MovimentacaoEstoque::where('observacao','Item Excluido')->where('estoque_id', $id)->get();
        $tamanho =count($teste);
        if($tamanho<1){
        MovimentacaoEstoque::create(
            [
                'estoque_id' => $estoque->id,
                'quantidade' => $estoque->quantidade,
                'preco_custo' => $estoque->movimentacaoEstoque->first()->preco_custo,
                'observacao' => "Item Excluido",
            ]
        );
    }
        $estoque->delete();
        return back()->with('success', 'Categoria Removida com sucesso');
        //
    }
    public function restore($id)
    {
        $teste = MovimentacaoEstoque::where('observacao','Item Excluido')->where('estoque_id', $id)->delete();
      
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
    public function saidaProdutos()
    {
        $data = [
            'estoque' => Estoque::withTrashed()->get(),
            'categorias' => Categoria::all(),
        ];
        return view('estoque::estoque.relatorios.saidaProdutos', compact('data'));
    }

    public static function verificarNotificacoes()
    {
        $itens = Estoque::where('quantidade', '<=', DB::raw('quantidade_notificacao'))->paginate(10);
        return count($itens);
    }

    public function relatorioCusto()
    {
        $query_result = DB::select(
            'SELECT distinct substring_index(created_at, " ", 1) as data,
            (SELECT nome FROM produto WHERE id = (SELECT produto_id FROM estoque_has_produto WHERE estoque_id = 3)) as nome,
            (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND estoque_id = 3 AND quantidade > 0) as qtd
             FROM movimentacao_estoque as me WHERE estoque_id = 3 order by data asc'
        );
        $labels = [];
        $dados = [];
        $data = [
            'estoque' => Estoque::all(),
            'labels' => json_encode($labels),
            'dados' => json_encode($dados),
            'flag' => "0"
        ];

        return view('estoque::estoque.relatorios.custo', compact('data'));
    }

    public function relatorioCustoResult($data_inicial, $data_final, $estoque_id){
        //Se for para selecionar o período com todos os estoques
        $query_result = [];
        $movimentacao = [];
        $maior_preco = 0;
        $quantidade_movimentada = 0;
        $estoque_selecionado = "EAE";
        $custo_total = "";
        $dia_maior_custo = 0;
        $dia_menor_custo = 0;

        if($estoque_id == -1){
            $estoque_selecionado = "Todo estoque";
        }else{
            $estoque = Estoque::findOrFail($estoque_id);
            $estoque_selecionado = $estoque->produtos->last()->nome . ' - ' . $estoque->tipoUnidade->nome . '(' . $estoque->tipoUnidade->quantidade_itens . ' itens)'; 
        }

        if ($estoque_id == -1) {
            $query_result = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND quantidade > 0) as qtd
                 FROM movimentacao_estoque as me WHERE
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                  order by data asc'
            );
            $movimentacao = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->where('quantidade', '>', 0)->get();
            $quantidade_movimentada = DB::select('SELECT SUM(quantidade) as qtd FROM movimentacao_estoque WHERE quantidade > 0 AND substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"');
            $maior_preco = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->max('preco_custo');
            $menor_preco = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->min('preco_custo');

            $dia_maior_custo = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND quantidade > 0) as valor
                FROM movimentacao_estoque as me WHERE
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                order by valor desc limit 1
                '
            );
            $dia_menor_custo = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND quantidade > 0) as valor
                FROM movimentacao_estoque as me WHERE
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                order by valor asc limit 1
                '
            );
            //Se for para selecionar o período com um estoque específico
        } else {
            $query_result = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT nome FROM produto WHERE id = (SELECT produto_id FROM estoque_has_produto WHERE estoque_id = ' . $estoque_id . ')) as nome,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND estoque_id = ' . $estoque_id . ' AND quantidade > 0) as qtd
                 FROM movimentacao_estoque as me WHERE estoque_id = ' . $estoque_id . ' AND
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                  order by data asc'
            );
            $maior_preco = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->where('estoque_id', $estoque_id)->where('quantidade', '>', 0)->max('preco_custo');
            $menor_preco = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->where('estoque_id', $estoque_id)->where('quantidade', '>', 0)->min('preco_custo');
            $movimentacao = MovimentacaoEstoque::whereBetween('created_at', array($data_inicial, $data_final))->where('quantidade', '>', 0)->where('estoque_id', $estoque_id)->get();
            $quantidade_movimentada = DB::select('SELECT SUM(quantidade) as qtd FROM movimentacao_estoque WHERE quantidade > 0 AND substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '" AND estoque_id = ' . $estoque_id);
            
            $dia_maior_custo = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE estoque_id = ' . $estoque_id . ' AND substring_index(created_at, " ", 1) = data AND quantidade > 0) as valor
                FROM movimentacao_estoque as me WHERE estoque_id = ' . $estoque_id . ' AND
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                order by valor desc limit 1
                '
            );
            $dia_menor_custo = DB::select(
                'SELECT distinct substring_index(created_at, " ", 1) as data,
                (SELECT SUM(quantidade*preco_custo) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND estoque_id = ' . $estoque_id . ' AND quantidade > 0) as valor
                FROM movimentacao_estoque as me WHERE estoque_id = ' . $estoque_id . ' AND
                 substring_index(created_at, " ", 1) BETWEEN "' . $data_inicial . '" AND "' . $data_final . '"
                order by valor asc limit 1
                '
            );
        }
        //Transfere as datas e os valores para um array especifico que será utilizado como labels e dados do gráfico
        $labels = [];
        $dados = [];
        foreach ($query_result as $q) {
            array_push($dados, $q->qtd);
            array_push($labels, $q->data);
        }

        $total = 0;
        foreach ($dados as $d) {
            $total += $d;
        }
        $custo_medio = 0;
        if(count($quantidade_movimentada) > 0){
            $custo_medio = round($total/$quantidade_movimentada[0]->qtd, 2);
        }

        if(count($dia_maior_custo) > 0){
            $dia_maior_custo = $dia_maior_custo[0]->data . ' - R$' . $dia_maior_custo[0]->valor;            
        }else{
            $dia_maior_custo = "";
        }

        if(count($dia_menor_custo) > 0){
            $dia_menor_custo = $dia_menor_custo[0]->data . ' - R$' . $dia_menor_custo[0]->valor;            
        }else{
            $dia_menor_custo = "";
        }
        

        $data = [
            'menor_custo' => $menor_preco,
            'estoque_id' => $estoque_id,
            'maior_custo' => $maior_preco,
            'custo_medio' => $custo_medio,
            'custo_total' => $total,
            'quantidade_movimentada' => $quantidade_movimentada[0]->qtd,
            'estoque' => Estoque::all(),
            'estoque_selecionado' => $estoque_selecionado,
            'labels' => json_encode($labels),
            'dados' => json_encode($dados),
            'flag' => "1",
            'movimentacao' => $movimentacao,
            'data_inicial' => $data_inicial,
            'data_final' => $data_final,
            'dia_maior_custo' => $dia_maior_custo,
            'dia_menor_custo' => $dia_menor_custo
        ];

        return $data;
    }

    public function relatorioCustoBusca(Request $req)
    {
        $data = $this->relatorioCustoResult($req->data_inicial, $req->data_final, $req->estoque_id);
        
        return view('estoque::estoque.relatorios.custo', compact('data'));
    }

    public function relatorioMovimentacao()
    {
        $categorias = Categoria::all();
        $data = [
            'flag' => "0",
            'dados' => "", 
            'labels' => "", 
            'estoque' => Estoque::all()
        ];
        return view('estoque::estoque.relatorios.movimentacao', compact('categorias', 'data'));
    }

    
    public function relatorioMovimentacaoBusca(Request $req){
        $ms = [];

        if ($req->estoque_id == -1){
            $ms  =  DB::select(
                    'SELECT distinct substring_index(created_at, " ", 1) as data,
                    (SELECT SUM(quantidade) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND quantidade > 0) as qtdEntrada,
                    (SELECT SUM(quantidade) FROM movimentacao_estoque WHERE substring_index(created_at, " ", 1) = data AND quantidade < 0) as qtdSaida
                        FROM movimentacao_estoque as me WHERE substring_index(created_at, " ", 1) BETWEEN "'.$req->dataInicial.'" AND "'.$req->dataFinal.'"
                            order by data asc'
        );   
        }else{
            $ms  =  DB::select(
                    'SELECT distinct substring_index(created_at," ", 1) as data,   
                     (SELECT SUM(quantidade) FROM movimentacao_estoque WHERE substring_index(created_at, " ",1) = data AND estoque_id = '.$req->estoque_id.' AND quantidade > 0) as qtdEntrada,
                     (SELECT SUM(quantidade) FROM movimentacao_estoque WHERE substring_index(created_at, " ",1) = data AND estoque_id = '.$req->estoque_id.' AND quantidade < 0) as qtdSaida
                        FROM movimentacao_estoque as me WHERE estoque_id = '.$req->estoque_id.' AND
                        substring_index(created_at, " ", 1) BETWEEN "'.$req->dataInicial.'" AND "'.$req->dataFinal.'"
                            order by data asc'
            );
        
        }
        $labels =[];
        $dadosEntrada =[];
        $dadosSaida = [];
        foreach ($ms as $q){
            array_push($dadosEntrada, $q->qtdEntrada);  
            array_push($dadosSaida, $q->qtdSaida * -1);         
            array_push($labels, $q->data);

        }
        $data = [
            'flag' => "1",
            'labels' => json_encode($labels),
            'dadosEntrada' => json_encode($dadosEntrada),
            'dadosSaida' => json_encode($dadosSaida),
            'estoque' => Estoque::all(),
            'categorias' => Categoria::all(),
            'dataInicial' => $req->dataInicial,
            'dataFinal' => $req->dataFinal
        ];
    return view('estoque::estoque.relatorios.movimentacao', compact('data'));
    }



    public function getSaidaProdutos(Request $request)
    {
        $dataForm = [
            'created_at' => '',
            'id' => $request->estoque,
            'inicio' => $request->inicio,
            'fim' => $request->fim,

        ];

        $movimentacao = ($dataForm['id'] != 0) ? DB::table('movimentacao_estoque')->where('estoque_id', $dataForm['id'])->where('observacao', '=', 'Item Excluido')->get() : DB::table('movimentacao_estoque')->where('observacao', '=', 'Item Excluido')->get();
        $data['estoque'] = DB::table('estoque')->where('deleted_at','<>',NULL)->where(function ($query) use ($dataForm) {
            if ($dataForm['id'] != 0) {
               
                $query->where('id', $dataForm['id']);
            }
            if ($dataForm['inicio'] != null) {
                $query->where('created_at', '>=', $dataForm['inicio']);
                if ($dataForm['fim'] != null) {
                    $query->where('created_at', '<=', $dataForm['fim']);
                }
            } else {
                if ($dataForm['fim'] != null) {
                    $query->where('created_at', '<=', $dataForm['fim']);
                }
            }
        })->get();
        $ids = array();
        foreach($data['estoque'] as $key=>$estoque){
        $ids[$key] = $data['estoque'][$key]->id;
        }
        $produtos = DB::table('produto')
        ->join('estoque_has_produto', function ($join) use ($ids) {
            $join->whereIn('estoque_id', $ids)->whereraw('produto.id = estoque_has_produto.produto_id');
        })->get();
       $data['produtos'] = $produtos;
        $data['movimentacao'] = $movimentacao;
        return json_encode($data);
    }
}
