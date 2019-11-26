<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Routing\Controller;
use Modules\estoque\Entities\{Categoria, Subcategoria};
use Modules\estoque\Http\Requests\CategoriaRequest;
use DB;
use Gate;

class CategoriaController extends Controller
{
    public $dadosTemplate;
    public $moduleInfo;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'Estoque',
        ];
        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
            ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('estoque/produto/categoria')],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
        ];
        $this->dadosTemplate = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    public function index()
    {
        $flag = 0;
        $categorias = Categoria::paginate(5);
        $categoriasInativas = Categoria::onlyTrashed()->paginate(5);
        return view('estoque::categoria.index', $this->dadosTemplate, compact('categorias', 'categoriasInativas','flag'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = ['titulo' => 'Cadastrar Categoria', 'button' => 'Cadastrar', 'url' => 'estoque/produto/categoria'];

        $categorias = Categoria::all();
        return view('estoque::categoria.form', $this->dadosTemplate, compact('data', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    /** Autor: Diego Magno 
     * descrição: método de inserção de categoria e subcategoria no banco
     */
    public function store(CategoriaRequest $request)
    {
        if (Gate::allows('operator',Auth::user())) {    
            DB::beginTransaction();
            try {
                $nome =  DB::table('categoria')->select('*')->where('nome','=' , $request->nome)->count();
                $categoria =  Categoria::create($request->all());
                $subcategoria = new Subcategoria();
                $subcategoria->id = $categoria->id;
                $subcategoria->categoria_id = ($request->categoriaPai != -1) ? $request->categoriaPai : null;
                if ($nome == 0) {
                    $subcategoria->save();
                } else {
                    return back()->with('warning', 'O nome selecionado já está cadastrado');
                }
                DB::commit();
                return redirect('/estoque/produto/categoria')->with('success', 'Categoria ' . $request->nome . ' cadastrada com sucesso');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('danger', 'Erro ao cadastrar categoria. cod:' . $e->getMessage());
            } 
        } else {         
            return redirect()->back()->with('error','Você não possui permissão para acessar a página!');
        }
    }

    public function edit($id)
    {
        $data = [
            'titulo' => 'Editar Categoria',
            'button' => 'Atualizar',
            'url' => 'estoque/produto/categoria/' . $id
        ];
        $categoria = Categoria::findOrFail($id);
        $categorias = Categoria::all()->except($id);
        $subcategoria = Subcategoria::findOrFail($id);
        return view('estoque::categoria.form', $this->dadosTemplate, compact('categoria', 'subcategoria', 'categorias', 'data'));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $categoria = Categoria::findOrFail($id);
            $subcategoria = Subcategoria::findOrFail($id);


            $nomeCategoria =  DB::table('categoria')->select('nome')->where('nome', $request->nome)->where('id','<>',$request->categoriaId)->get()->count();
        
            if ($nomeCategoria != 0) {
                return back()->with('warning', 'Este nome já está cadastrado');
            }
            $categoria->update($request->all());
            if ($request->categoriaPai != -1) {
                $subcategoria->categoria_id = $request->categoriaPai;
            }
            $subcategoria->categoria_id = ($request->categoriaPai != -1) ? $request->categoriaPai : null;
            $subcategoria->save();
            DB::commit();

            return redirect('/estoque/produto/categoria')->with('success', 'Categoria ' . $request->nome . ' editada com sucesso');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('danger', 'Erro ao editar categoria. Cód:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();
        return back()->with('success', 'Categoria Removida com sucesso');
        //
    }
    public function restore($id)
    {

        $categoria = Categoria::onlyTrashed()->findOrFail($id);

        $categoria->restore();
        return back()->with('success', 'categoria ' . $categoria->nome . " restaurada com sucesso");
    }
    public function verificaNome(Request $request)
    {

        if ($request->id != 0) {
            $categorias =  DB::table('categoria')
                ->whereNotIn('id', $request->id)->select('nome')->where('nome', $request->nome)->count();
        } else
            $categorias = DB::table('categoria')->select('nome')->where('nome', $request->nome)->count();


        return $categorias;
    }
    public function inativos(){
        $flag =1;
        $categoriasInativas = Categoria::onlyTrashed()->paginate(10);
        $categorias = Categoria::paginate(5);
        return view('estoque::categoria.index', $this->dadosTemplate,compact('flag','categoriasInativas','categorias'));
    }
}
