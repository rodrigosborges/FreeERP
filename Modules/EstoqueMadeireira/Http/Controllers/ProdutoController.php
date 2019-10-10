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
            ['icon' => 'add_box', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
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
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        $produtos = Produto::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Produtos/index', $this->template, compact('categorias', 'fornecedores', 'produtos', 'flag'));
    }

    public function inativos()
    {
        $produtos = Produto::onlyTrashed()->paginate(5);
        $categorias = Categoria::all();
        $fornecedores = Fornecedores::all();
        $flag = 1;

        return view('estoquemadeireira::Produtos/index', $this->template, compact('produtos', 'categorias', 'flag', 'fornecedores'));
    }

    public function restaurar($id){
        $produtos = Produto::onlyTrashed()->findOrFail($id);
        $produtos->restore();

        return redirect('estoquemadeireira::Produtos/index')->with('success', 'Produto restaurado com sucesso!');



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
    public function store(Request $req)
    {
       
        DB::beginTransaction();
        try{
            Produto::create($req->all());
            DB::commit();

            return redirect('/estoquemadeireira/produtos')->with('Success', 'Produto cadastrado com sucesso!');
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
        // $data = [
        //     'produto' => Produto::findOrFail($id),
        //     'fornecedores' => Fornecedor::all(),
        //     'categorias' => Categoria::all()
        //     ];
        $produtos = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();

        return view('estoquemadeireira::produtos/form', $this->template, compact('produtos', 'categorias', 'fornecedores'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
  
    



    public function ficha($id){
        $produtos = Produto::findOrFail($id);

        return view('estoquemadeireira::produtos/ficha', $this->template, compact('produtos'));

    }


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
