<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Fornecedor;
use Modules\EstoqueMadeireira\Http\Requests\FornecedorRequest;
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

        return view('estoquemadeireira::Fornecedores/index', $this->template, compact('fornecedores', 'flag',));
    }

    public function restore($id){
       
        $fornecedores-> Fornecedor::onlyTrashed()->findOrFail($id);
        $fornecedores->restore();

        return redirect('estoquemadeireira/produtos/fornecedores')->with('success', 'Fornecedor restaurado com sucesso!');

    }

    public function create()
    {
        $fornecedores = Fornecedor::all();     
        return view('estoquemadeireira::Fornecedores/form', $this->template, compact('fornecedores'));

        
    }


    public function store(FornecedorRequest $req)
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
       
        $fornecedor = Fornecedor::findOrFail($id);
    

        return view('estoquemadeireira::fornecedores/form', $this->template, compact('fornecedor'));
    }


     public function update(FornecedorRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $fornecedor = Fornecedor::findOrFail($id);
            $fornecedor->update($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos/fornecedores')->with('success', 'Fornecedor atualizado com sucesso!');
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect('/estoquemadeireira/produtos/fornecedores')->with('success', 'Fornecedor desativado com sucesso!');
    }


}
