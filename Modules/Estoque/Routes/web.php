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
  
    route::get('produto/categoria/inativos','CategoriaController@inativos');
    route::resource('produto/categoria', 'CategoriaController');
    route::PUT('produto/categoria/restore/{id}', 'CategoriaController@restore');
    Route::resource('/produto/unidade', 'UnidadeProdutoController');


    //Delete e Restore tipo_produto (UnidadeProduto)
    Route::put('/produto/unidade/{id}/restore', 'UnidadeProdutoController@restore');
    
    //Rota tipo unidade
    Route::get('tipo-unidade/inativos', 'TipoUnidadeController@inativos'); 
    Route::resource('/tipo-unidade', 'TipoUnidadeController'); 
    Route::put('tipo-unidade/{id}/restore','TipoUnidadeController@restore');
    
  
    
    //Rota de Busca
    Route::post('/produto/busca', 'ProdutoController@busca');
    
    //Rota produtos inativos
    Route::get('/produto/inativos', 'ProdutoController@inativos');

    
    Route::resource('/produto', 'ProdutoController');

    //preview ficha
    Route::get('/produto/ficha/{id}', 'ProdutoController@gerarFicha');
    

    //Restaurar Produto
    Route::put('/produto/{id}/restore', 'ProdutoController@restore');

    //Rotas do Estoque
    Route::resource('/', 'EstoqueController');
    
});
Route::post('verificaNomeCategoria','CategoriaController@verificaNome');
 
