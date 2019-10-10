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

    //ROTA DE PRODUTOS
    Route::get('/produtos/inativos', 'ProdutoController@inativos');
    Route::get('/produtos/ficha/{id}', 'ProdutoController@ficha');
    Route::put('/produtos/{id}/restore', 'ProdutoController@restore');
    Route::resource('/produtos', 'ProdutoController');  

    
    

   

});

