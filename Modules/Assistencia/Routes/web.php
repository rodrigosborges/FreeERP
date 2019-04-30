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

Route::prefix('assistencia')->group(function() {
    Route::get('/', 'AssistenciaController@index');
    /* Clientes*/
    Route::get('cliente',['as'=>'cliente.index','uses'=>'ClienteController@index']);
    Route::get('cliente/cadastrar',['as'=>'cliente.cadastrar','uses'=>'ClienteController@cadastrar']);
    Route::post('cliente/salvar',['as'=>'cliente.salvar','uses'=>'ClienteController@salvar']);
    Route::get('cliente/localizar',['as'=>'cliente.localizar','uses'=>'ClienteController@localizar']);
    Route::get('cliente/editar/{id}',['as'=>'cliente.editar','uses'=>'ClienteController@editar']);
    Route::put('cliente/atualizar/{id}',['as'=>'cliente.atualizar','uses'=>'ClienteController@atualizar']);
    Route::get('cliente/deletar/{id}',['as'=>'cliente.deletar','uses'=>'ClienteController@deletar']);
    Route::post('cliente/buscar',['as'=>'cliente.buscar','uses'=>'ClienteController@buscar']);
    /* Clientes*/
    /*Estoque (peça e serviço) */
    Route::get('estoque',['as'=>'estoque.index','uses'=>'EstoqueController@index']);
    Route::get('estoque/pecas/cadastrar',['as'=>'pecas.cadastrar','uses'=>'PecasController@cadastrar']);
    Route::post('estoque/pecas/salvar',['as'=>'pecas.salvar','uses'=>'PecasController@salvar']);
    Route::get('estoque/pecas/localizar',['as'=>'pecas.localizar','uses'=>'PecasController@localizar']);
    Route::get('estoquepecas//editar/{id}',['as'=>'pecas.editar','uses'=>'PecasController@editar']);
    Route::put('estoque/pecas/atualizar/{id}',['as'=>'pecas.atualizar','uses'=>'PecasController@atualizar']);
    Route::get('estoque/pecas/deletar/{id}',['as'=>'pecas.deletar','uses'=>'PecasController@deletar']);
    Route::post('estoque/pecas/buscar',['as'=>'pecas.buscar','uses'=>'PecasController@buscar']);

    Route::get('estoque/servicos/cadastrar',['as'=>'servicos.cadastrar','uses'=>'ServicosController@cadastrar']);
    Route::post('estoque/servicos/salvar',['as'=>'servicos.salvar','uses'=>'ServicosController@salvar']);
    Route::get('estoque/servicos/localizar',['as'=>'servicos.localizar','uses'=>'ServicosController@localizar']);
    Route::get('estoque/servicos/editar/{id}',['as'=>'servicos.editar','uses'=>'ServicosController@editar']);
    Route::put('estoque/servicos/atualizar/{id}',['as'=>'servicos.atualizar','uses'=>'ServicosController@atualizar']);
    Route::get('estoque/servicos/deletar/{id}',['as'=>'servicos.deletar','uses'=>'ServicosController@deletar']);
    Route::post('estoque/servicos/buscar',['as'=>'servicos.buscar','uses'=>'ServicosController@buscar']);
    /*Estoque (peça e serviço) */

    /*consertos/ Ordem de servicos*/
    Route::get('consertos',['as'=>'consertos.index','uses'=>'consertoController@index']);
    Route::get('consertos/cadastrar',['as'=>'consertos.cadastrar','uses'=>'consertoController@cadastrar']);
    Route::post('consertos/salvar',['as'=>'consertos.salvar','uses'=>'consertoController@salvar']);
});











Route::get('assistencia/pagamento',['as'=>'pagamento.index','uses'=>'PagamentoController@index']);
