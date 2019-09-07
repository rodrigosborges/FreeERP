<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Estoque\Entities\{Produto,Estoque, TipoUnidade};

class EstoqueController extends Controller
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
        $this->dadosTemplate = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu,
        ];
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return view('estoque::estoque.index', $this->dadosTemplate);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'titulo'  => 'Cadastrar Estoque',
            'button'  => 'Cadastrar',
            'url'     => 'estoque',
            'estoque' => null,
            'produtos'=>Produto::all(),
            'tipoUnidade' =>TipoUnidade::all(),
        ];
        return view('estoque::estoque.form', compact('data'));
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
