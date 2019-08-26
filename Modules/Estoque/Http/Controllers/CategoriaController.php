<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Routing\Controller;
use Modules\estoque\Entities\{Categoria, Subcategoria};
use Modules\estoque\Http\Requests\CategoriaRequest;
use DB;

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
            ['icon' => 'people', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
            ['icon' => 'work', 'tool' => 'Categoria', 'route' => url('estoque/produto/categoria')],
        ];
        $this->dadosTemplate = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    public function index()
    {
        $categorias = Categoria::all();
        $categoriasInativas = Categoria::onlyTrashed()->get();
        return view('estoque::categoria.index', $this->dadosTemplate, compact('categorias', 'categoriasInativas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $data = ['titulo' => 'Cadastrar Categoria', 'button' => 'Cadastrar'];

        $categorias = Categoria::all();
        return view('estoque::categoria.form', $this->dadosTemplate, compact('data', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        try {

            $categoria =  Categoria::create($request->all());
            $subcategoria = new Subcategoria();
            $subcategoria->id = $categoria->id;
            if ($request->categoriaPai != -1) {
                $subcategoria->categoria_id = $request->categoriaPai;
            }
            $subcategoria->save();
            DB::commit();
            return back()->with('success', 'Categoria ' . $request->nome . ' cadastrada com sucesso');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('danger', 'Erro ao cadastrar categoria. cod:' . $e->getMessage());
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
        $data = ['titulo' => 'Editar Categoria', 'button' => 'Editar'];
        $categoria = Categoria::findOrFail($id);
        $categorias = Categoria::all();
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
            $categoria->update($request->all());
            $subcategoria->update($request->all());
            DB::commit();

            return back()->with('success', 'Categoria ' . $request->nome . ' editada com sucesso');
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
}
