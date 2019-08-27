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

//função que cria todas rotas de todas função da Classe

Route::prefix('cliente')->group(function() {
    
    Route::resource('/cliente', 'ClienteController');

    Route::get('{id}/pedido', 'PedidoController@index');

    Route::get('/','ClienteController@index');
});

