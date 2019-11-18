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
    //FORNECEDOR DE PRODUTOS PARA O ESTOQUE, Classe "simples" para apenas registrar quem fornece 'X' produto;
    //propriedades: Nome para identificação OBRIGATÓRIO, Endereço genérico OBRIGATÓRIO, CNPJ OBRIGATÓRIO, Telefone (Pode ser 8 ou 9 digitos, apenas um: Tel ou Cel), email OBRIGATÓRIO
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
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],

            

        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }


    //Lista 5 Fornecedores por página, carregando Nome e Cnpj, além dos botões de editar e visualizar ficha (desativa pela ficha)   ROTA: '/estoquemadeireira/produtos/fornecedores'
    //A variável flag serve para carregar os ativos e os inativos na mesma view, onde 
    //Flag = 0: ATIVOS ; Flag = 1: INATIVOS
    public function index()
    {
        $fornecedores = Fornecedor::paginate(5);
        $flag = 0;
      
        return view('estoquemadeireira::Fornecedores/index', $this->template, compact('fornecedores', 'flag'));
    }


    //Retorna o index de fornecedores inativos no sistema, sendo possível recupera-los com a função RESTORE
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

    //Criação do Fornecedor com todos os seus atributos, já validando no back e front (store)

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

            return redirect('/estoquemadeireira/produtos/fornecedores')->with('Success', 'Fornecedor cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Fornecedor');
        }
    }

    //Edita o Fornecedor selecionado pelo id, retorna as informações atuais no formulário sendo possível atualiza-los (update)
    
    public function edit($id)
    {

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


    //Desativa o fornecedor do sistema, sendo possível reativa-lo depois

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect('/estoquemadeireira/produtos/fornecedores')->with('success', 'Fornecedor desativado com sucesso!');
    }

    
    
    //Ficha do fornecedor, passando o id do mesmo para que se tenha uma melhor visualização  ROTA: /estoquemadeireira/produtos/fornecedores/ficha/{ID} 

    public function ficha($id){
        $fornecedor = Fornecedor::findOrFail($id);
        return view('estoquemadeireira::fornecedores/ficha',$this->template , compact('fornecedor'));
    }

    
    //Função de busca de fornecedor, filtrando os fornecedores APENAS pelo Nome

    public function busca(Request $request){
        $sql = [];
        $fornecedores = Fornecedor::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/produtos/fornecedores')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        //Flag = 0 (index de ativos) retorna os fornecedores ativos
        //Flag = 1 (index de inativos) retorna os fornecedores inativos (onlyTrashed)
        
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

