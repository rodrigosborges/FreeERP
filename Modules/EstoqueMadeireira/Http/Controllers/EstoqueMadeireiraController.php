<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Estoque;
use Modules\EstoqueMadeireira\Entities\tipoUnidade;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EstoqueMadeireiraController extends Controller
{
    public $template;

    public function __construct(){
        $moduleInfo = [
            'icon' => 'store',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
            ['icon' => 'class', 'tool' => 'Categorias', 'route' => '/estoquemadeireira/produtos/categorias'],
            ['icon' => 'account_circle', 'tool' => 'Fornecedores', 'route' => '/estoquemadeireira/produtos/fornecedores'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],


        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    public function index()
    {
        $flag = 0;
        $notificacoes = '';
        $estoques = Estoque::paginate(5);
        return view('estoquemadeireira::estoque.index', $this->template, compact('estoques', 'flag', 'notificacoes'));     
    }


    //TIPO UNIDADE ABAIXO


    public function tipoUnidadeindex(){
        $flag = 0;
        $tipoUnidade = tipoUnidade::paginate(5);
        

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipoUnidade', 'flag'));

    }

    public function tipoUnidadeinativos(){
        $flag = 1;
        $tipoUnidade = tipoUnidade::onlyTrashed()->paginate(5);

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipoUnidade', 'flag'));


    }

    public function createTipoUnidade(){

    }

    public function storeTipoUnidade(Request $request){

    }

    public function deleteTipoUnidade($id){


    }

    public function editTipoUnidade($id){

    }

    //FIM TIPO UNIDADE




    public function create()
    {
        return view('estoquemadeireira::create');
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
