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

Route::prefix('estoque')->group(function() {
    Route::get('/', 'EstoqueController@index');
    route::resource('produto/categoria', 'CategoriaController');
    Route::resource('produto','ProdutoController');
    Route::resource('/produto/unidade', 'UnidadeProdutoController');
    
    //Restaurar Produto
    Route::put('/produto/{id}/restore', 'ProdutoController@restore');

    
});

