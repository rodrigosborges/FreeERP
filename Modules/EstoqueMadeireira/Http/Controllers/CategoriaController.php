<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class CategoriaController extends Controller
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
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],

        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }



    public function index()
    {
        $categorias = Categoria::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Categoria/index', $this->template, compact('categorias', 'flag'));
    }

    public function inativos()
    {
        $categorias = Categoria::onlyTrashed()->paginate(5);
        $flag = 1;

        return view('estoquemadeireira::Categoria/index', $this->template, compact('categorias', 'flag',));
    }

    public function restore($id){
       
        $categoria = Categoria::onlyTrashed()->findOrFail($id);
        $categoria->restore();

        return redirect('estoquemadeireira/produtos/categorias')->with('success', 'Categoria restaurada com sucesso!');

    }

    public function create()
    {
        $categorias = Categoria::all();
       
        
        return view('estoquemadeireira::categoria/form', $this->template, compact('categorias'));

        
    }


    public function store(CategoriaRequest $req)
    {
       
        DB::beginTransaction();
        try{
            Categoria::create($req->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos/categorias')->with('Success', 'Categoria cadastrada com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Categoria');
        }
    }

    public function edit($id)
    {
        // $data = [
        //     'produto' => Produto::findOrFail($id),
        //     'fornecedores' => Fornecedor::all(),
        //     'categorias' => Categoria::all()
        //     ];
       
        $categoria = Categoria::findOrFail($id);      
        return view('estoquemadeireira::categoria.form', $this->template, compact('categoria'));
    }


     public function update(CategoriaRequest $request, $id)
    {

        DB::beginTransaction();
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Categoria atualizada com sucesso!');
      
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }


    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Categoria desativada com sucesso!');
    }


    public function busca(Request $request){
        $sql = [];
        $categorias = Categoria::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
        if($request['flag'] == 1){
            $categorias = Categoria::onlyTrashed()->where($sql)->paginate(5);
            if(count($categorias) == 0){
                return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Categoria.index', $this->template, compact('categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
            $categorias = Categoria::where($sql)->paginate(5);
            if(count($categorias) == 0){
                return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::Categoria.index', $this->template, compact('categorias', 'flag'))->with('success', 'Resultado da pesquisa');
        }
    }

    }
}


