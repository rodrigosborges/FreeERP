<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\tipoUnidade;
use Modules\EstoqueMadeireira\Http\Requests\tipoUnidadeRequest;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class tipoUnidadeController extends Controller
{

    //TIPO DE UNIDADE DE ESTOQUE: Serve para especifícar em que parte do estoque está X produto, carrega o nome como: Box 1, Box 2, etc.
    //Propriedade: Nome para identificação
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
   
    //Página inicial de tipo de unidade, carrega 5 tipos por página e apresenta as opções de editar e deletar
    //A variável flag serve para carregar os ativos e os inativos na mesma view, onde 
    //Flag = 0: ATIVOS ; Flag = 1: INATIVOS
    
    public function index(){
        $flag = 0;
        $tipos = tipoUnidade::paginate(5);
        

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'));

    }

    //retorna a página inicial com os inativos, que podem ser reativados 
    
    public function inativos(){
        $flag = 1;
        $tipos = tipoUnidade::onlyTrashed()->paginate(5);

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'));


    }

    //Função de criação de tipo de unidade (store), onde a váriavel $data carrega todas as informações necessárias para a view de uma só vez, sem a necessidade de declarar
    //de passar mais de uma váriavel no compact

    public function create()
    {
        
        $data = [
            'button' => 'cadastrar',
            'url' =>'estoquemadeireira/tipounidade',
            'tipo' => null,
        ];
        
        
        return view('estoquemadeireira::tipoUnidade.form', $this->template, compact('data'));
    }


    public function store(tipoUnidadeRequest $request)
    {
     
        DB::beginTransaction();
        try{
            tipoUnidade::create($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/tipounidade')->with('Success', 'Tipo de Unidade cadastrado com sucesso!');
        } catch(\Exeception $e) {
            return back()->with('Error', 'Erro no cadastro de Tipo de Unidade');
        }
    }


    //Função para editar o tipo de unidade, carregando pelo ID e atualizando as informações
    
    public function edit($id)
    {
        $tipo = TipoUnidade::findOrFail($id);
        $data = [
            'button' => 'atualizar',
            'url' => 'estoquemadeireira/tipounidade/' . $id,
            'tipo' => TipoUnidade::findOrFail($id),
            'titulo' => 'Editar Unidade',
        ];
        return view('estoquemadeireira::tipoUnidade.form', $this->template, compact('data', 'tipo'));
    }

    //Função que atualiza o tipo de unidade que for passado por ID


    public function update(tipoUnidadeRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $tipo = tipoUnidade::findOrFail($id);
            $tipo->update($request->all());
            DB::commit();
            return redirect('/estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade atualizado com sucesso!');
        }catch  (\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
        
    }


   

    //Função para desativar um tipo de unidade

    public function destroy($id)
    {
        $tipo = tipoUnidade::findOrFail($id);
        $tipo->delete();
        return redirect('estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade desativada com sucesso!');
    }


    //Função para reativar um tipo de unidade desativado do sistema, na view Index de Inativos

    public function restore($id){
        $tipo = tipoUnidade::onlyTrashed()->findOrFail($id);
        $tipo->restore();
        return redirect('estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade reativado!');
    }



    //Função de busca dos tipos de unidade registrados, filtro: Nome

    public function busca(Request $request){
       
        $sql = [];
        $tipos = tipoUnidade::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/tipounidade')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        //FLAG é passada pelo Index ou Index de inativos
        //Flag = 0 (index de ativos) retorna os tipos de unidade ativos
        //Flag = 1 (index de inativos) retorna os tipos de unidade inativos(onlyTrashed)

        if($request['flag'] == 1){
            $tipos = tipoUnidade::onlyTrashed()->where($sql)->paginate(5);
            if(count($tipos) == 0){
                return redirect('/estoquemadeireira/tipounidade')->with('error', 'Nenhum resultado encontrado');
            }
            $flag = $request['flag'];
            return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'))->with('success', 'Resultado da pesquisa');
        }else{
                $tipos = tipoUnidade::where($sql)->paginate(5);
                if(count($tipos) == 0){
                    return redirect('/estoquemadeireira/tipounidade')->with('error', 'Nenhum resultado encontrado');
                }
                $flag = $request['flag'];
                return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'))->with('success', 'Resultado da pesquisa');
            }
        }
    }
}
