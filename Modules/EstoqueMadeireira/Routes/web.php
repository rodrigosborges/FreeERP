<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('estoquemadeireira')->group(function() {
    

    
    //ROTAS DE BUSCAS
    Route::post('/busca', 'EstoqueMadeireiraController@busca');                     //BUSCA DO ESTOQUES
    Route::post('/tiponidade/busca', 'tipoUnidadeController@busca');                //BUSCA DE NOME DE UNIDADES
    Route::post('/produtos/busca', 'ProdutoController@busca');                      //BUSCA DE PRODUTOS
    Route::post('/produtos/categorias/busca', 'CategoriaController@busca');         //BUSCA DE CATEGORIAS
    Route::post('/produtos/fornecedores/busca', 'FornecedorController@busca');      //BUSCA DE FORNECEDORES
    Route::post('/movimentacao/buscar', 'MovimentacaoEstoqueController@buscar');    //BUSCA DE MOVIMENTAÇÕES
    Route::post('/vendas/clientes/busca', 'ClienteController@busca');               //BUSCA DE CLIENTES


    //PRODUTOS
    Route::get('/produtos/inativos', 'ProdutoController@inativos'); 
    Route::get('/produtos/ficha/{id}', 'ProdutoController@ficha');
    Route::put('/produtos/{id}/restore', 'ProdutoController@restore');


    //FORNECEDORES 
    Route::get('/produtos/fornecedores/inativos', 'FornecedorController@inativos');
    Route::get('produtos/fornecedores/ficha/{id}', 'FornecedorController@ficha');
    Route::put('produtos/fornecedores/{id}/restore', 'FornecedorController@restore');
    

    //CATEGORIAS
    Route::get('/produtos/categorias/inativos', 'CategoriaController@inativos');
    Route::put('/produtos/categorias/{id}/restore', 'CategoriaController@restore');


    //TIPO DE UNIDADE
    Route::get('/tipounidade/inativos', 'tipoUnidadeController@inativos');
    Route::put('/tipounidade/{id}/restore', 'tipoUnidadeController@restore');


    //MOVIMENTAÇÃO 
    Route::get('/movimentacao/alterar/{id}', 'MovimentacaoEstoqueController@alterarEstoque');
    Route::get('/movimentacao/alterar/{id}/adicionar', 'MovimentacaoEstoqueController@adicionar');
    Route::post('/movimentacao/alterar', 'MovimentacaoEstoqueController@salvarEstoque');
    Route::get('/movimentacao/alterar/{id}/remover', 'MovimentacaoEstoqueController@remover');

    //CLIENTES
    Route::get('/vendas/clientes/inativos', 'ClienteController@inativos');
    Route::put('/vendas/clientes/{id}/restore', 'ClienteController@restore');
    Route::get('/vendas/clientes/ficha/{id}', 'ClienteController@ficha');
    
    //PEDIDOS
    Route::get('/vendas/pedidos/abertos', 'PedidoController@abertos');
    Route::get('/vendas/pedidos/enviados', 'PedidoController@enviados');
    Route::get('/vendas/pedidos/finalizados', 'PedidoController@finalizados');

    //ROTAS DE RELATÓRIOS
    Route::get('/relatorios/movimentacao', 'EstoqueMadeireiraController@relatorioMovimentacao');
    Route::post('/relatorios/movimentacao', 'EstoqueMadeireiraController@relatorioMovimentacaoBusca');

    

    //ESTOQUE
    Route::get('/inativos', 'EstoqueMadeireiraController@inativos');
    Route::put('/{id}/restore', 'EstoqueMadeireiraController@restore');



    //VENDAS
    
    

    //ROTAS PADRÕES (index, create, edit, update, delete)
    Route::resource('/vendas/pedidos', 'PedidoController');                  //Pedidos
    Route::resource('/vendas/clientes', 'ClienteController');                //Clientes
    Route::resource('/vendas', 'VendasController');                          //Vendas
    Route::resource('/movimentacao', 'MovimentacaoEstoqueController');       //Movimentações
    Route::resource('/produtos/fornecedores', 'FornecedorController');       //Fornecedores
    Route::resource('/produtos/categorias', 'CategoriaController');          //Categorias
    Route::resource('/produtos', 'ProdutoController');                       //Produtos
    Route::resource('/tipounidade', 'tipoUnidadeController');                //Tpo de Unidade (NOME DE UNIDADE)

    
    


   

});

Route::resource('/estoquemadeireira', 'EstoqueMadeireiraController'); 
Route::get('/buscacliente', 'PedidoController@buscaCliente');