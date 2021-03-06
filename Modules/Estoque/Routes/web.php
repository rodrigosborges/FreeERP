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

Route::prefix('estoque')->group(function () {
    Route::post('/pdf', 'EstoqueController@pdf');
    route::put('/{id}/restore','EstoqueController@restore');
    route::get('/inativos', 'EstoqueController@inativos');
    route::get('/notificacoes', 'EstoqueController@notificacoes');
    route::get('produto/categoria/inativos', 'CategoriaController@inativos');
    route::resource('produto/categoria', 'CategoriaController');
    route::PUT('produto/categoria/restore/{id}', 'CategoriaController@restore');
    Route::resource('/produto/unidade', 'UnidadeProdutoController');


    //Delete e Restore tipo_produto (UnidadeProduto)
    Route::put('/produto/unidade/{id}/restore', 'UnidadeProdutoController@restore');

    //Rota tipo unidade
    Route::get('tipo-unidade/inativos', 'TipoUnidadeController@inativos');
    Route::resource('/tipo-unidade', 'TipoUnidadeController');
    Route::put('tipo-unidade/{id}/restore', 'TipoUnidadeController@restore');



    //Rota de Busca
    Route::post('/produto/busca', 'ProdutoController@busca');

    //Rota produtos inativos
    Route::get('/produto/inativos', 'ProdutoController@inativos');


    Route::resource('/produto', 'ProdutoController');

    //preview ficha
    Route::get('/produto/ficha/{id}', 'ProdutoController@gerarFicha');


    //Restaurar Produto
    Route::put('/produto/{id}/restore', 'ProdutoController@restore');

    //Rota das movimentações
    Route::get('/movimentacao/alterar/{id}', 'MovimentacaoEstoqueController@alterarEstoque');
    Route::get('/movimentacao/alterar/{id}/adicionar', 'MovimentacaoEstoqueController@adicionar');
    Route::post('/movimentacao/alterar', 'MovimentacaoEstoqueController@salvarEstoque');
    Route::get('/movimentacao/alterar/{id}/remover', 'MovimentacaoEstoqueController@remover');
    Route::post('/movimentacao/buscar', 'MovimentacaoEstoqueController@buscar');
    Route::resource('/movimentacao', 'MovimentacaoEstoqueController');

    //Rotas de Relatório
    Route::get('/relatorio/custos', 'EstoqueController@relatorioCusto');
    Route::post('/relatorio/custos', 'EstoqueController@relatorioCustoBusca');
    Route::get('/relatorio/movimentacao', 'EstoqueController@relatorioMovimentacao');
    Route::post('/relatorio/movimentacao', 'EstoqueController@relatorioMovimentacaoBusca');
    Route::get('/relatorio/saida-produtos', 'EstoqueController@saidaProdutos');

   // Route::get('/relatorio/custos/chart', 'EstoqueController@chartCusto');
    //Rotas do Estoque
    Route::post('/buscar', 'EstoqueController@buscar');

});
Route::resource('/estoque', 'EstoqueController');
//Rotas Ajax
Route::post('verificaNomeCategoria', 'CategoriaController@verificaNome');
Route::post('buscaUnidades', 'EstoqueController@buscaUnidades');
Route::post('estoque/relatorio/saida', 'EstoqueController@getSaidaProdutos');

