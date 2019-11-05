<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Fornecedor;
use Modules\EstoqueMadeireira\Entities\Categoria;

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
            'icon' => 'store',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'shopping_basket', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
            ['icon' => 'class', 'tool' => 'Categorias', 'route' => '/estoquemadeireira/produtos/categorias'],
            ['icon' => 'account_circle', 'tool' => 'Fornecedores', 'route' => '/estoquemadeireira/produtos/fornecedores'],
            ['icon' => 'store', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],

            

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
       
        $fornecedor = Fornecedor::onlyTrashed()->findOrFail($id);
        $fornecedor->restore();

        return redirect('estoquemadeireira/produtos/fornecedores')->with('success', 'Fornecedor restaurado com sucesso!');

    }

    public function create()
    {
        $fornecedores = Fornecedor::all();  
        $categorias = Categoria::all();   
        return view('estoquemadeireira::Fornecedores/form', $this->template, compact('fornecedores', 'categorias'));

        
    }


    public function store(FornecedorRequest $req)
    {
       
        DB::beginTransaction();
        try{
            Fornecedor::create($req->all());
            DB::commit();

            return redirect('/estoquemadeireira/produtos/fornecedores')->with('Success', 'Fornecedor cadastrado com sucesso!');
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
        $categorias = Categoria::all();
    

        return view('estoquemadeireira::fornecedores/form', $this->template, compact('fornecedor','categorias'));
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

    public function ficha($id){
        $fornecedor = Fornecedor::findOrFail($id);
        $categoria = Categoria::findOrFail($fornecedor->categoria_id);
        return view('estoquemadeireira::fornecedores/ficha',$this->template , compact('fornecedor', 'categoria'));
    }

    public function busca(Request $request){
        $sql = [];
        $fornecedores = Fornecedor::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/produtos/fornecedores')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
        if($request['flag'] == 1){
            $fornecedores = Fornecedor::onlyTrashed()->where($sql)->paginate(5);
            if(count($fornecedores) == 0){
                return redirect('/estoquemadeireira/produtos/fornecedores')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Fornecedores.index', $this->template, compact('fornecedores', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $fornecedores = Fornecedor::where($sql)->paginate(5);
            if(count($fornecedores) == 0){
                return redirect('/estoquemadeireira/produtos/fornecedores')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Fornecedores.index', $this->template, compact('fornecedores', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }

    }
}

