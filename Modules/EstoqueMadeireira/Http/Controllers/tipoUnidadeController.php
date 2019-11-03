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
   

    public function index(){
        $flag = 0;
        $tipos = tipoUnidade::paginate(5);
        

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'));

    }

    public function inativos(){
        $flag = 1;
        $tipos = tipoUnidade::onlyTrashed()->paginate(5);

        return view('estoquemadeireira::tipoUnidade.index', $this->template, compact('tipos', 'flag'));


    }


    public function create()
    {
        
        $data = [
            'button' => 'cadastrar',
            'url' =>'estoquemadeireira/tipounidade',
            'tipo' => null,
        ];
        
        
        return view('estoquemadeireira::tipoUnidade.form', $this->template, compact('data'));
    }


    public function store(Request $request)
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

    public function show($id)
    {
        return view('estoquemadeireira::show');
    }

    
    public function edit($id)
    {
        $tipo = tipoUnidade::findOrFail($id);

        return view('estoquemadeireira::tipoUnidade.form', $this->template, compact('tipo'));
    }

    public function restore($id){
        $tipo = tipoUnidade::onlyTrashed()->findOrFail($id);
        $tipo->restore();
        return redirect('estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade reativado!');
    }
   

    public function update(Request $request, $id)
    {
     DB::beginTransaction();
     try{
         $tipo = tipoUnidade::findOrFail($id);
         $tipo->update($request->all());
         DB:commit();
         return redirect('/estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade atualizado com sucesso!');
     }catch  (\Exception $e){
         DB::rollback();
         return back()->with('error', 'Erro no servidor');
     }
        
    }



    public function destroy($id)
    {
        $tipo = tipoUnidade::findOrFail($id);
        $tipo->delete();
        return redirect('estoquemadeireira/tipounidade')->with('success', 'Tipo de unidade desativada com sucesso!');
    }

    public function busca(Request $request){
        $sql = [];
        $tipos = tipoUnidade::all();
        
        
        if($request['pesquisa'] == null){
            return redirect('/estoquemadeireira/tipounidade')->with('error', 'Insira um nome para a pesquisa');

        }else{
            array_push($sql,['nome', 'like', '%' . $request['pesquisa'] . '%']);
        
        
        
        //Se a flag for 1 retorna os produtos inativos, se for 2 os produtos ativos
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
