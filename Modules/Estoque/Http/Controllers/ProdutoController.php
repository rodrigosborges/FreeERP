<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Estoque\Http\Requests\ProdutoRequest;
use Modules\Estoque\Entities\Produto;
use Modules\Estoque\Entities\UnidadeProduto;
use Modules\Estoque\Entities\Categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $produtosInativos = Produto::onlyTrashed()->get();
        return view('estoque::index', compact('produtos', 'produtosInativos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $unidades = UnidadeProduto::all();
        return view('estoque::produto.form', compact('unidades', 'categorias'));
    }

    public function store(ProdutoRequest $request)
    {
        DB::beginTransaction();
        try{
            Produto::create($request->all());
            DB::commit();
            return redirect('/estoque/produto')->with('success', 'Produto cadastrado com sucesso');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $unidades = UnidadeProduto::all();
        return view('estoque::produto.form', compact('produto', 'unidades', 'categorias'));
    }
    public function update(ProdutoRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $produto = Produto::findOrFail($id);
            $produto->update($request->all());
            DB::commit();
            return redirect('/estoque/produto')->with('success', 'Produto alterado com sucesso');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return back()->with('success', 'Produto desativado com sucesso!');
    }

    public function restore($id){
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();
        return back()->with('success', 'Produto ativado com sucesso!');
    }
}
