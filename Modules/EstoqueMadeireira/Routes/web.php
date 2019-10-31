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
    Route::post('/produtos/busca', 'ProdutoController@busca');
    Route::post('/produtos/categorias/busca', 'CategoriaController@busca');
    Route::post('/produtos/fornecedores/busca', 'FornecedorController@busca');
    
    Route::get('/produtos/fornecedores/inativos', 'FornecedorController@inativos');
    Route::get('/produtos/categorias/inativos', 'CategoriaController@inativos');

    Route::resource('/produtos/fornecedores', 'FornecedorController');
    Route::resource('/produtos/categorias', 'CategoriaController'); 
    Route::get('produtos/fornecedores/ficha/{id}', 'FornecedorController@ficha');
    Route::put('produtos/fornecedores/{id}/restore', 'FornecedorController@restore');

    
    //ROTA DE PRODUTOS
    Route::get('/produtos/inativos', 'ProdutoController@inativos'); 
    Route::get('/produtos/ficha/{id}', 'ProdutoController@ficha');
    Route::put('/produtos/{id}/restore', 'ProdutoController@restore');
    
    Route::resource('/produtos', 'ProdutoController');  
    
    
    //ROTA DE CATEGORIA
    Route::put('/produtos/categorias/{id}/restore', 'CategoriaController@restore');
    

   

});
