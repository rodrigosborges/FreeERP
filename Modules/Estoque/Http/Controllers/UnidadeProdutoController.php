<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\UnidadeProduto;
use Modules\Estoque\Http\Requests\UnidadeProdutoRequest;
use Modules\Estoque\Http\Controllers\EstoqueController;
use DB;

class UnidadeProdutoController extends Controller
{
    protected $notificacoes;
    public $dadosTemplate;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct(){
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'Estoque',
        ];
        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
            ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('/estoque/produto/categoria')],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
        ];
        $this->dadosTemplate =  [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
        $this->notificacoes = EstoqueController::verificarNotificacoes();
    }
    public function index()
    {
        $unidadeProduto = UnidadeProduto::paginate(5);
        $unidadesExcluidas = UnidadeProduto::onlyTrashed()->paginate(5);
        return view('estoque::produto.unidade.index',$this->dadosTemplate, compact('unidadeProduto', 'unidadesExcluidas'))->with('notificacoes', $this->notificacoes);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('estoque::produto.unidade.form', $this->dadosTemplate)->with('notificacoes', $this->notificacoes);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UnidadeProdutoRequest $request)
    {
        
        DB::beginTransaction();
        try{
            UnidadeProduto::create($request->all());
            DB::commit();
            return redirect('/estoque/produto/unidade')->with('success', 'Unidade cadastrada com sucesso');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
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
        $unidadeProduto = UnidadeProduto::findOrFail($id);
        return view('estoque::produto.unidade.form', $this->dadosTemplate, compact('unidadeProduto'))->with('notificacoes', $this->notificacoes);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UnidadeProdutoRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $unidadeProduto = UnidadeProduto::findOrFail($id);
            $unidadeProduto->update($request->all());
            DB::commit();
            return redirect('/estoque/produto/unidade')->with('success', 'Unidade alterada com sucesso');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */

    public function restore($id){
        $unidadeProduto = UnidadeProduto::onlyTrashed()->findOrFail($id);
        $unidadeProduto->restore();
        return back()->with('success', 'Unidade ativada com sucesso!');
    }

    public function destroy($id) {
        $unidadeProduto = UnidadeProduto::findOrFail($id);
        $unidadeProduto->delete();
        return back()->with('success', 'Unidade desativada com sucesso!');
    }

}
