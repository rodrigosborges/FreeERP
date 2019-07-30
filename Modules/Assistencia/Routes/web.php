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
    /* /Clientes*/
    /* tecnicos*/
    Route::get('tecnico',['as'=>'tecnico.index','uses'=>'TecnicoController@index']);
    Route::get('tecnico/cadastrar',['as'=>'tecnico.cadastrar','uses'=>'TecnicoController@cadastrar']);
    Route::post('tecnico/salvar',['as'=>'tecnico.salvar','uses'=>'TecnicoController@salvar']);
    Route::get('tecnico/localizar',['as'=>'tecnico.localizar','uses'=>'TecnicoController@localizar']);
    Route::get('tecnico/editar/{id}',['as'=>'tecnico.editar','uses'=>'TecnicoController@editar']);
    Route::put('tecnico/atualizar/{id}',['as'=>'tecnico.atualizar','uses'=>'TecnicoController@atualizar']);
    Route::get('tecnico/deletar/{id}',['as'=>'tecnico.deletar','uses'=>'TecnicoController@deletar']);
    Route::post('tecnico/buscar',['as'=>'tecnico.buscar','uses'=>'TecnicoController@buscar']);
    /* /tecnicos*/
    /*Estoque (peça e serviço) */
    Route::get('estoque',['as'=>'estoque.index','uses'=>'EstoqueController@index']);

    Route::get('estoque/pecas/cadastrar',['as'=>'pecas.cadastrar','uses'=>'PecasController@cadastrar']);
    Route::post('estoque/pecas/salvar',['as'=>'pecas.salvar','uses'=>'PecasController@salvar']);
    Route::get('estoque/pecas/localizar',['as'=>'pecas.localizar','uses'=>'PecasController@localizar']);
    Route::get('estoque/pecas/editar/{id}',['as'=>'pecas.editar','uses'=>'PecasController@editar']);
    Route::put('estoque/pecas/atualizar/{id}',['as'=>'pecas.atualizar','uses'=>'PecasController@atualizar']);
    Route::get('estoque/pecas/deletar/{id}',['as'=>'pecas.deletar','uses'=>'PecasController@deletar']);
    Route::post('estoque/pecas/buscar',['as'=>'pecas.buscar','uses'=>'PecasController@buscar']);
    Route::get('estoque/pecas/deletarItem/{id}',['as'=>'itemPeca.deletar','uses'=>'PecasController@deletarItem']);


    Route::get('estoque/servicos/cadastrar',['as'=>'servicos.cadastrar','uses'=>'ServicosController@cadastrar']);
    Route::post('estoque/servicos/salvar',['as'=>'servicos.salvar','uses'=>'ServicosController@salvar']);
    Route::get('estoque/servicos/localizar',['as'=>'servicos.localizar','uses'=>'ServicosController@localizar']);
    Route::get('estoque/servicos/editar/{id}',['as'=>'servicos.editar','uses'=>'ServicosController@editar']);
    Route::put('estoque/servicos/atualizar/{id}',['as'=>'servicos.atualizar','uses'=>'ServicosController@atualizar']);
    Route::get('estoque/servicos/deletar/{id}',['as'=>'servicos.deletar','uses'=>'ServicosController@deletar']);
    Route::post('estoque/servicos/buscar',['as'=>'servicos.buscar','uses'=>'ServicosController@buscar']);
    /*Estoque (peça e serviço) */

    /*consertos/ Ordem de servicos*/
    Route::get('consertos', ['as'=>'consertos.index','uses'=>'ConsertoController@localizar']);
    Route::get('consertos/cadastrar',['as'=>'consertos.cadastrar','uses'=>'ConsertoController@cadastrar']);
    Route::get('consertos/localizar',['as'=>'consertos.localizar','uses'=>'ConsertoController@localizar']);
    Route::get('consertos/visualizar/{id}',['as'=>'consertos.visualizar','uses'=>'ConsertoController@visualizarConserto']);
    Route::post('consertos/buscar',['as'=>'consertos.buscar','uses'=>'ConsertoController@buscar']);
    Route::get('conserto/nomeClientes',['as'=>'consertos.nomeClientes','uses'=>'ConsertoController@nomeClientes']);
    Route::get('conserto/dadosCliente',['as'=>'consertos.dadosCliente','uses'=>'ConsertoController@dadosCliente']);
    Route::get('conserto/nomeTecnicos',['as'=>'consertos.nomeTecnicos','uses'=>'ConsertoController@nomeTecnicos']);
    Route::get('conserto/dadosTecnico',['as'=>'consertos.dadosTecnico','uses'=>'ConsertoController@dadosTecnico']);
    Route::post('conserto/salvar',['as' => 'consertos.salvar','uses' => 'ConsertoController@salvar']);
    Route::get('conserto/editar/{id}',[ 'as' =>'consertos.editar','uses' => 'ConsertoController@editar']);
    Route::get('conserto/finalizar/{id}',[ 'as' =>'consertos.finalizar','uses' => 'ConsertoController@finalizar']);
    Route::post('conserto/editar/{id}/salvar',[ 'as' =>'consertos.atualizar','uses' => 'ConsertoController@atualizar']);
    /*Pagamentos*/
    Route::get('pagamento', ['as'=>'pagamento.index','uses'=>'PagamentoController@index']);
    Route::post('pagamento/{id}/salvar', ['as'=>'pagamento.salvar','uses'=>'PagamentoController@salvar']);
    Route::get('pagamento/recibo-{id}', ['as'=>'pagamento.recibo','uses'=>'PagamentoController@recibo']);

});





/*
    Route::get('conserto/nomeServicos',['as'=>'consertos.nomeServicos','uses'=>'ConsertoController@nomeServicos']);
    Route::get('conserto/dadosServicos',['as'=>'consertos.dadosServicos','uses'=>'ConsertoController@dadosServicos']);
    Route::get('conserto/nomePecas',['as'=>'consertos.nomePecas','uses'=>'ConsertoController@NomePecas']);
    Route::get('conserto/dadosPecas',['as'=>'consertos.dadosPecas','uses'=>'ConsertoController@dadosPecas']);
*/