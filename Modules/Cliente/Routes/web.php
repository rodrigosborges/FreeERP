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

Route::prefix('cliente')->group(function() {
        
    Route::resource('/cliente', 'ClienteController'); //função que cria todas rotas de todas função da Classe
    Route::post('/cliente/busca',['as'=>'cliente.buscar','uses'=>'ClienteController@buscar']);

    Route::get('{cliente_id}/pedido', 'PedidoController@index');
    Route::get('{cliente_id}/pedido/novo', 'PedidoController@novo');

    Route::delete('pedido/{pedido_id}', 'PedidoController@destroy');
    Route::get('pedido/{pedido_id}','PedidoController@edit');


    Route::post('{cliente_id}/pedido/','PedidoController@store');

    
    Route::get('/','ClienteController@index');
});

