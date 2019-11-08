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
    //CATEGORIA DE PRODUTOS, essa classe determina a que categoria X produto pertence
    //Propriedade: Nome OBRIGATÓRIO
    //A função construct carrega as informações do template padrão do sistema, passado no $this->template



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

    //Inicio da sessão Categorias, carrega 5 categorias registradas, com Nome, e os botões de Editar e Deletar
    //A variável flag serve para carregar os ativos e os inativos na mesma view, onde 
    //Flag = 0: ATIVOS ; Flag = 1: INATIVOS

    public function index()
    {
        $categorias = Categoria::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Categoria/index', $this->template, compact('categorias', 'flag'));
    }

    //Retorna os inativos, com a opção de reativa-los 

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

    //Insere a nova categoria no banco (store), verificando se já não existe um registro igual no banco

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

    //Retorna o formulário com a categoria passada para ser editada 

    public function edit($id)
    {

       
        $categoria = Categoria::findOrFail($id);      
        return view('estoquemadeireira::categoria.form', $this->template, compact('categoria'));
    }

    //Atualiza a Categoria

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

    //Desativa a Categoria do sistema, sendo possível reativa-la depois

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect('/estoquemadeireira/produtos/categorias')->with('success', 'Categoria desativada com sucesso!');
    }


    //Função para encontrar uma categoria registrada, filtrando pelo Nome

    public function busca(Request $request){
        $sql = [];
        $categorias = Categoria::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/produtos/categorias')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        //Flag = 0 (index de ativos) retorna as categorias ativas
        //Flag = 1 (index de inativos) retorna as categorias inativas (onlyTrashed)
        
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