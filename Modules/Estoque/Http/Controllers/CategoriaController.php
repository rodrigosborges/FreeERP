<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\estoque\Entities\Categoria;

class CategoriaController extends Controller
{
    public $dadosTemplate;
    public $moduleInfo;
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
            ['icon' => 'people', 'tool' => 'Produto', 'route' => url('')],
            ['icon' => 'work', 'tool' => 'Categoria', 'route' => url('')],
        ];
        $this->dadosTemplate =['moduleInfo'=>$moduleInfo,
            'menu'=>$menu];
    }
    public function index()
    {
        $categorias = Categoria::all();
    
        return view('estoque::categoria.index', $this->dadosTemplate, compact('categorias') );
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
        return view('estoque::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        
        $categoria= Categoria::findOrFail($id);
        return view('estoque::categoria.form',$this->dadosTemplate ,compact('categoria'));
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
        dd($request);
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
