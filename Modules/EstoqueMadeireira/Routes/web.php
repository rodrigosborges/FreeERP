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
    Route::get('/', 'EstoqueMadeireiraController@index');
   
    
    
    //ROTAS DE BUSCAS
    Route::post('/busca', 'EstoqueMadeireiraController@busca');
    Route::post('/tiponidade/busca', 'tipoUnidadeController@busca');
    Route::post('/produtos/busca', 'ProdutoController@busca');
    Route::post('/produtos/categorias/busca', 'CategoriaController@busca');
    Route::post('/produtos/fornecedores/busca', 'FornecedorController@busca');
    Route::post('/movimentacao/buscar', 'MovimentacaoEstoqueController@buscar');
    Route::post('/buscar', 'EstoqueMadeireiraController@busca');

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
    Route::resource('/movimentacao', 'MovimentacaoEstoqueController');

    //ESTOQUE


    //ROTAS DE RELATÓRIO
    Route::get('/relatorio/movimentacao', 'EstoqueController@relatorioMovimentacao');
    Route::post('/relatorio/movimentacao', 'EstoqueController@relatorioMovimentacaoBusca');



    //ROTAS PADRÕES DO LARAVEL 
    Route::resource('/estoquemadeireira', 'EstoqueMadeireiraController');
    Route::resource('/vendas/cliente', 'ClienteController');
    Route::resource('/produtos/fornecedores', 'FornecedorController');
    Route::resource('/produtos/categorias', 'CategoriaController'); 
    Route::resource('/produtos', 'ProdutoController');  
    Route::resource('/tipounidade', 'tipoUnidadeController');

    


   

});

