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
    Route::get('/', 'EstoqueController@index');
    route::resource('produto/categoria', 'CategoriaController');
    route::PUT('produto/categoria/restore/{id}', 'CategoriaController@restore');
    Route::resource('/produto/unidade', 'UnidadeProdutoController');

    //Delete e Restore tipo_produto (UnidadeProduto)
    Route::put('/produto/unidade/{id}/restore', 'UnidadeProdutoController@restore');
    
    Route::resource('/produto', 'ProdutoController');
    

    //Restaurar Produto
    Route::put('/produto/{id}/restore', 'ProdutoController@restore');
    
});
