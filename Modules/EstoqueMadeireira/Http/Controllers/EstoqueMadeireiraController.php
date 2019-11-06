<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;
use Modules\EstoqueMadeireira\Entities\Estoque;
use Modules\EstoqueMadeireira\Entities\tipoUnidade;
use Modules\EstoqueMadeireira\Entities\Categoria;
use Modules\EstoqueMadeireira\Entities\MovimentacaoEstoque;
use Modules\EstoqueMadeireira\Entities\Produto;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


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
            ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],
            ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],


        ];
        $this->template = [
            'moduleInfo' => $moduleInfo,
            'menu' => $menu
        ];
    }
    
    
    
    
    //Tela inicial
    public function index()
    {
        $flag = 0;
        $notificacoes = $this->verificarNotificacao();
        $itens = Estoque::paginate(5);
        return view('estoquemadeireira::estoque.index', $this->template, compact('itens', 'flag', 'notificacoes'));     
    }


    


    //Criação do estoque, usando 'data' para comprimir todos os dados em uma só variável, e passando as notificações pro template
    public function create()
    {
       
       
        $notificacao = $this->verificarNotificacao();
        $data = [
            'titulo' => 'Cadastrar Estoque',
            'button' => 'Cadastrar',
            'url' => 'estoque',
            'estoque' => null,
            'produtos' => Produto::all(),
            'tipoUnidade' => TipoUnidade::all()
        ];

        return view('estoquemadeireira::.estoque.form', compact('data', 'notificao'));
    }


    //Função para salvar o estoque no Banco 
    public function store(Request $request)
    {
        try{
            $estoque = Estoque::create($request->all());
            $produto = Produto::findOrFail($request->produto_id);
            $estoque->produtos()->attach($produto);
            $estoque->save();
            MovimentacaoEstoque::create(
                [
                    'estoque_id' => $estoque->id,
                    'quantidade' => $estoque->quantidade,
                    'preco_custo' => $request['preco_custo'],
                    'observacao' => "Entrada Inicial",
                ]
            );
            DB::commit();
            return redirect('/estoque')->with('success', 'Item de estoque registrado com sucesso!');
        } 
        catch (Exception $ex) {
            DB::rollback();
            return back()->with('danger', "Erro ao tentar registrar item. cod:" + $ex->getMessage());
        }
    }

    



    public function edit($id)
    {
        return view('estoquemadeireira::edit');
    }


    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }

    public static function verificarNotificacao()
    {
        $itens = Estoque::where('quantidade', '<=', DB::raw('quantidade_notificacao'))->paginate(10);
        return count($itens);
    }

}
