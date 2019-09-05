<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Estoque\Http\Requests\ProdutoRequest;
use Modules\Estoque\Entities\Produto;
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
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
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
        $categorias = Categoria::all();
        return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos', 'categorias'));
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
        /*
        $categoriasPai = DB::table('categoria')
        ->join('subcategoria','subcategoria.id', '=','categoria.id')
        ->where('subcategoria.categoria_id', '=', null)
        ->get();
        */
        //$categorias = DB::table('categoria')->join('subcategoria','subcategoria.id', '=','categoria.id')->where('subcategoria.categoria_id = null')->get();
        $categorias = Categoria::all();
        return view('estoque::produto.form',$this->dadosTemplate, compact('categorias'));
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

    public function gerarFicha($id) 
    {
        $produto = Produto::findOrFail($id);
        
        return view('estoque::/produto.ficha', $this->dadosTemplate, compact('produto'));
    
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        return view('estoque::produto.form', $this->dadosTemplate, compact('produto', 'categorias'));
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
        return redirect('/estoque/produto')->with('success'   , 'Produto desativado com sucesso!');
    }

   

    public function restore($id)
    {
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();
        return redirect('/estoque/produto')->with('success', 'Produto ativado com sucesso!');
    }


    public function busca(Request $request)
    {
        $sql = [];
        $categorias = Categoria::all();
        
        if($request['pesquisa'] == null){
            
        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        }

        if($request['categoria_id'] != -1){
            array_push($sql, ['categoria_id', '=', $request['categoria_id']]);
        }else{

        }
        if($request['preco_min'] != null){
            if($request['preco_max'] != null){
                array_push($sql, ['preco', '>=', $request['preco_min']]);
                array_push($sql, ['preco', '<=', $request['preco_max']]);
            }else{
                array_push($sql, ['preco', '>=', $request['preco_min']]);
            }
        }else if($request['preco_max'] != null){
                array_push($sql, ['preco', '<=', $request['preco_max']]);
        }
        
        $produtosInativos = Produto::onlyTrashed()->where($sql)->paginate(5);
        $produtos = Produto::where($sql)->paginate(5);

        if(count($produtos) == 0 && count($produtosInativos) == 0){
            return redirect('/estoque/produto')->with('error', 'Nenhum resultado encontrado');
        }

        return view('estoque::produto.index', $this->dadosTemplate, compact('produtos', 'categorias','produtosInativos'))->with('success', 'Resultado da pesquisa');

    }

    public function inativos()
    {
        
        $produtos = Produto::onlyTrashed()->paginate(5);
        return view('estoque::/produto/index',$this->dadosTemplate, compact('produtos'));
    }
}
