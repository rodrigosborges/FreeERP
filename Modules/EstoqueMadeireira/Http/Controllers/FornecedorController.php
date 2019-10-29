<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class FornecedorController extends Controller
{


    public $template;

    public function __construct(){
        $moduleInfo = [
            'icon' => 'android',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'add_box', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
            ['icon' => 'add_box', 'tool' => 'Categorias', 'route' => '/estoquemadeireira/produtos/categorias'],
            ['icon' => 'add_box', 'tool' => 'Fornecedores', 'route' => '/estoquemadeireira/produtos/fornecedores'],
            ['icon' => 'edit', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],

        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }



    public function index()
    {
        $fornecedores = Fornecedor::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Fornecedores/index', $this->template, compact('fornecedores', 'flag'));
    }

    public function inativos()
    {
        $fornecedores = Fornecedor::onlyTrashed()->paginate(5);
        $flag = 1;

        return view('estoquemadeireira::Categoria/index', $this->template, compact('fornecedores', 'flag',));
    }

    public function restore($id){
       
        $categoria = Categoria::onlyTrashed()->findOrFail($id);
        $categoria->restore();

        return redirect('estoquemadeireira/produtos/categorias')->with('success', 'Categoria restaurada com sucesso!');

    }

    public function create()
    {
        $fornecedores = Fornecedor::all();     
        return view('estoquemadeireira::Fornecedores/form', $this->template, compact('fornecedores'));

        
    }


    public function store(Request $req)
    {
       
        DB::beginTransaction();
        try{
            Fornecedor::create($req->all());
            DB::commit();

            return redirect('/estoquemadeireira/produtos/categorias')->with('Success', 'Fornecedor cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Fornecedor');
        }
    }

    public function edit($id)
    {
        // $data = [
        //     'produto' => Produto::findOrFail($id),
        //     'fornecedores' => Fornecedor::all(),
        //     'categorias' => Categoria::all()
        //     ];
       
        $categorias = Categoria::all();
    

        return view('estoquemadeireira::produtos/categorias/form', $this->template, compact('categorias'));
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
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Produto desativado com sucesso!');
    }

    public function gitmanodoceu(){
        return 1;
    }
}
