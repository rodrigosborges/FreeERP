<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\{MovimentacaoEstoque, Estoque};
use Modules\Estoque\Http\Requests\MovimentacaoRequest;
use DB;

class MovimentacaoEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $movimentacao = MovimentacaoEstoque::paginate(10);
        
        return view('estoque::estoque.movimentacao.index', compact('movimentacao'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('estoque::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        
        $movimentacao = MovimentacaoEstoque::findOrFail($id);
        return view('estoque::estoque.movimentacao.ficha', compact('movimentacao'));
    }


    public function adicionar($id){
        $estoque = Estoque::findOrFail($id);
        $flag = 1;

        return view('estoque::estoque.movimentacao.form', compact('estoque', 'flag'));
    }


    public function remover($id){
        $estoque = Estoque::findOrFail($id);
        $flag = 0;
        
        return view('estoque::estoque.movimentacao.form', compact('estoque', 'flag'));
    }


    public function alterarEstoque($id){
        $e = Estoque::findOrFail($id);
        $movimentacao = MovimentacaoEstoque::where('estoque_id', $e->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('estoque::estoque.movimentacao.visualizar', compact('e', 'movimentacao'));


    }

    public function salvarEstoque(MovimentacaoRequest $request){
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
            return redirect('/estoque/movimentacao/alterar/' . $estoque->produtos->last()->id)->with('success', 'Registro salvo');
        }catch(\Exception $e){
            return back()->with('error', 'Erro no servidor');
        }


    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('estoque::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
