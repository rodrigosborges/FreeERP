<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;


use Modules\EstoqueMadeireira\Entities\Produto;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Entities\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */


    public $template;
    public function __construct(){
        $moduleInfo = [
            'icon' => 'android',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastro', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Pedidos', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Estoque', 'route' => '#'],
        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }


    public function index()
    {


        return view('estoquemadeireira::Produtos/index',$this->template);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        
        
        return view('estoquemadeireira::Produtos/form', $this->template, compact('categorias', 'fornecedores'));

        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            Produto::create($request->all());
            DB::commit();

            return redirect('/estoqueMadeireira/produtos')->with('Success', 'Produto cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Produto');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('estoquemadeireira::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('estoquemadeireira::edit');
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
