<?php
namespace Modules\EstoqueMadeireira\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EstoqueMadeireira\Entities\{MovimentacaoEstoque, Estoque, Produto};
use Modules\EstoqueMadeireira\Http\Requests\MovimentacaoRequest;
use Modules\EstoqueMadeireira\Http\Controllers\EstoqueMadeireiraController;
use DB;



class MovimentacaoEstoqueController extends Controller
{
    
    // protected $notificacoes;
    // public function __construct(){
    //     $this->notificacoes = EstoqueMadeireiraController::verificarNotificacao();
    // }


    public function index()
    {
        $movimentacao = MovimentacaoEstoque::orderBy('created_at', 'DESC')->paginate(10);
        return view('estoquemadeireira::estoque.movimentacao.index', compact('movimentacao'));
    }





    public function show($id)
    {
        
        $movimentacao = MovimentacaoEstoque::findOrFail($id);
        return view('estoquemadeireira::estoque.movimentacao.ficha', compact('movimentacao'));
    }
    
    
    
    
    public function adicionar($id){
        $estoque = Estoque::findOrFail($id);
        $flag = 1;
        return view('estoquemadeireira::estoque.movimentacao.form', compact('estoque', 'flag'));
    }





    public function remover($id){
        $estoque = Estoque::findOrFail($id);
        $flag = 0;
        
        return view('estoquemadeireira::estoque.movimentacao.form', compact('estoque', 'flag'));
    }




    public function alterarEstoque($id){
        $e = Estoque::findOrFail($id);
        $movimentacao = MovimentacaoEstoque::where('estoque_id', $e->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('estoquemadeireira::estoque.movimentacao.visualizar', compact('e', 'movimentacao'));
    }



    public function salvarEstoque(Request $request){
        $estoque = Estoque::findOrFail($request->estoque_id);
        DB::beginTransaction(); 
        try{
            if($request->flag == 1){
                $estoque->quantidade = $estoque->quantidade + $request->quantidade;
            }else if($request->flag == 0){
                $request->quantidade = $request->quantidade*-1;
                $estoque->quantidade = $estoque->quantidade + ($request->quantidade);
                if($estoque->quantidade < 0){
                    return back()->with('error', 'Estoque insuficiente');
                }
            }else{
                return back()->with('error', 'Erro no servidor');
            }
            //quantidade','observacao','estoque_id','preco_custo'
                 MovimentacaoEstoque::create([
                    'quantidade' => $request->quantidade,
                    'observacao' => $request->observacao,
                    'estoque_id' => $request->estoque_id,
                    'preco_custo' => $request->preco_custo
                ]);
                $estoque->update();
                DB::commit();
            return redirect('/estoquemadeireira/movimentacao/alterar/' . $estoque->id)->with('success', 'Registro salvo');
        }catch(\Exception $e){
            return back()->with('error', 'Erro no servidor');
        }
    }




    public function edit($id)
    {
        return view('estoque::edit');
    }

    public function buscar(Request $request)
    {
        if($request->pesquisa == null){
            $movimentacao = MovimentacaoEstoque::paginate(10);
            return redirect('/estoquemadeireira/movimentacao');
        }else{
            $movimentacao = MovimentacaoEstoque::where('id', $request->pesquisa)->orWhere('quantidade', $request->pesquisa)->paginate(10);
            if(count($movimentacao) > 0){
                return view('estoquemadeireira::estoque.movimentacao.index', compact('movimentacao'))->with('success', 'Resultado da Pesquisa');
            }else{
                return redirect('/estoquemadeireira/movimentacao')->with('error', 'Nenhum resultado encontrado');
            }
        }
        
        return view('estoque::estoque.movimentacao.index', compact('movimentacao'));
        if($request->pesquisa == null){
            $itens = Estoque::paginate(10);
            return view('estoquemadeireira::estoque.index', $this->template, compact('itens','flag'));
        }else{  
            $itens = DB::table('estoque')
            ->join('estoque_has_produto', 'estoque_has_produto.estoque_id', '=', 'estoque.id')
            ->join('produto', 'produto.id', '=', 'estoque_has_produto.produto_id') 
            ->where('produto.nome', 'like', '%' . $request->pesquisa . '%')->paginate(10);   
            return view('estoque::estoque.index', $this->template, compact('itens','flag'));
  
        }
    }
}