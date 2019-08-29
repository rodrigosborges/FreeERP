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
        ];
        $this->dadosTemplate =  [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    public function index()
    {
       
        $produtos = Produto::paginate(5);
        $produtosInativos = Produto::onlyTrashed()->paginate(5);
        return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos'));
    }
    /*
    public function busca(Request $request)
    {
        if($request['pesquisa']){
          
            $produtos = Produto::where('nome', 'like', '%'.$request['pesquisa'].'%');
            // $produtosInativos = Produto::onlyTrashed()->get();
            return view('estoque::/produto/index', compact('produtos'));     
        }   
        $produtos = Produto::all();
        $produtosInativos = Produto::onlyTrashed()->get();
        return view('estoque::/produto/index', compact('produtos', 'produtosInativos'));
    }
*/
    public function create()
    {
        //$categorias = DB::table('categoria')->join('subcategoria','subcategoria.id', '=','categoria.id')->where('subcategoria.categoria_id = null')->get();
        $categorias = Categoria::all();
        $unidades = UnidadeProduto::all();
        return view('estoque::produto.form',$this->dadosTemplate, compact('unidades', 'categorias'));
    }

    public function store(ProdutoRequest $request)
    {
        DB::beginTransaction();
        try {
            Produto::create($request->all());
            DB::commit();
            return redirect('/estoque/produto')->with('success', 'Produto cadastrado com sucesso');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $unidades = UnidadeProduto::all();
        return view('estoque::produto.form', $this->dadosTemplate, compact('produto', 'unidades', 'categorias'));
    }
    public function update(ProdutoRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $produto = Produto::findOrFail($id);
            $produto->update($request->all());
            DB::commit();
            return redirect('/estoque/produto')->with('success', 'Produto alterado com sucesso');
        } catch (\Exception $e) {
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

    public function restore($id)
    {
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();
        return back()->with('success', 'Produto ativado com sucesso!');
    }


    public function busca(Request $request)
    {
        $flag = false;
        $title = 'Resultado da Pesquisa';
        if ($request['pesquisa']) {
            $produtos = Produto::where('nome', 'like', '%' . $request['pesquisa'] . '%')->get();
        }
        $produtosInativos = Produto::onlyTrashed()->get();
        return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos', 'title'));
    }

    public function inativos()
    {
        
        $produtos = Produto::onlyTrashed()->paginate(5);
        return view('estoque::/produto/index',$this->dadosTemplate, compact('produtos'));
    }
}
