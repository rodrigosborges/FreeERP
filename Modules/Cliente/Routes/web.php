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

    Route::get('dashboard','DashboardController@index');
    
        
    Route::resource('/cliente', 'ClienteController'); //função que cria todas rotas de todas função da Classe
    Route::get('/cliente/table/{status}', 'ClienteController@table');

    Route::get('{cliente_id}/pedido', 'PedidoController@index');//Lista pedidos
    Route::get('{cliente_id}/pedido/novo', 'PedidoController@novo');// Novo pedido
    
    Route::delete('pedido/{pedido_id}', 'PedidoController@destroy')->name('delete.pedido');//Deletar pedido
    Route::get('pedido/{pedido_id}','PedidoController@edit');//Abrir view eddição


    Route::put('pedido/{pedido_id}','PedidoController@update'); //Salvar alteracao
    Route::post('{cliente_id}/pedido/','PedidoController@store');//Salvar Novo pedido
    Route::delete('pedido','PedidoController@deleteMultiples');//Deletar varios

    Route::get('{cliente_id}/pedidos/pdf/{start}/{end}', 'PedidoController@pdf'); //Teste pdf

    Route::get('/dashboard/totalvendasmes/{ano}','DashBoardController@getVendasMes');
    

    Route::get('/','ClienteController@index');
});


