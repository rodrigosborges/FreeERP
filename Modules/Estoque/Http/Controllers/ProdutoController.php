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
        $categorias = Categoria::all();
        foreach($categorias as $categoria) {
            if($categoria->id == $produto->categoria_id)
                $categorias = Categoria::findOrFail($categoria->id);
        }
        
        return view('estoque::/produto.ficha', $this->dadosTemplate, compact('produto','categorias'));
    
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
        return back()->with('success'   , 'Produto desativado com sucesso!');
    }

   

    public function restore($id)
    {
        $produto = Produto::onlyTrashed()->findOrFail($id);
        $produto->restore();
        return back()->with('success', 'Produto ativado com sucesso!');
    }


    public function busca(Request $request)
    {
        $categorias = Categoria::all();

        if ($request['pesquisa'] == null ){
            if($request['categoria_id'] != -1){
                $produtos = Produto::where('categoria_id', $request['categoria_id'])->paginate(5);
                $produtosInativos = Produto::onlyTrashed()->where('categoria_id', $request['categoria_id'])->paginate(5);
                
                return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos', 'categorias'));

            }else{
                $produtos = Produto::paginate(5);
                $produtosInativos = Produto::onlyTrashed()->paginate(5);
                return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'categorias', 'produtosInativos'));
            }
        } else {
            if($request['categoria_id'] != -1){
                $produtos = Produto::where([
                    ['nome', 'like', '%' . $request['pesquisa'] . '%'],
                    ['categoria_id', '=', $request['categoria_id']]
                ])->paginate(5);
                $produtosInativos = Produto::where([
                    ['nome', 'like', '%' . $request['pesquisa'] . '%'],
                    ['categoria_id', '=', $request['categoria_id']]
                ])->onlyTrashed()->paginate(5);
                
                if(count($produtos) == 0 && count($produtosInativos) == 0){
                    return redirect('/estoque/produto')->with('error', 'Nenhum resultado encontrado');
                } else{
                    return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos', 'categorias'));
                }
            }else{
                $produtos = Produto::where('nome', 'like', '%' . $request['pesquisa'] . '%')->paginate(5);
                $produtosInativos = Produto::where('nome', 'like', '%' . $request['pesquisa'] . '%')->onlyTrashed()->paginate(5);
                
                if(count($produtos) == 0 && count($produtosInativos) == 0){
                    return redirect('/estoque/produto')->with('error', 'Nenhum resultado encontrado');
                } else{
                    return view('estoque::/produto/index', $this->dadosTemplate, compact('produtos', 'produtosInativos', 'categorias'));
                }
            }
        }
    }

    public function inativos()
    {
        
        $produtos = Produto::onlyTrashed()->paginate(5);
        return view('estoque::/produto/index',$this->dadosTemplate, compact('produtos'));
    }
}
