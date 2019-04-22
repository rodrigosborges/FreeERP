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
});
/* Clientes*/
Route::get('assistencia/clientes',['as'=>'cliente.index','uses'=>'ClienteController@index']);

Route::get('assistencia/cadastrar',['as'=>'cliente.cadastrar','uses'=>'ClienteController@cadastrar']);
Route::post('assistencia/salvar',['as'=>'cliente.salvar','uses'=>'ClienteController@salvar']);
Route::get('assistencia/localizar',['as'=>'cliente.localizar','uses'=>'ClienteController@localizar']);
Route::get('assistencia/editar/{id}',['as'=>'cliente.editar','uses'=>'ClienteController@editar']);
Route::put('assistencia/atualizar/{id}',['as'=>'cliente.atualizar','uses'=>'ClienteController@atualizar']);
Route::get('assistencia/deletar/{id}',['as'=>'cliente.deletar','uses'=>'ClienteController@deletar']);
/* Clientes*/


Route::get('assistencia/estoque',['as'=>'estoque.index','uses'=>'EstoqueController@index']);

Route::get('assistencia/estoque/cadastrar_peca',['as'=>'pecas.cadastrar','uses'=>'PecasController@cadastrar']);
Route::post('assistencia/estoque/salvar_peca',['as'=>'pecas.salvar','uses'=>'PecasController@salvar']);
Route::get('assistencia/estoque/localizar_peca',['as'=>'pecas.localizar','uses'=>'PecasController@localizar']);
Route::get('assistencia/estoque/editar_peca/{id}',['as'=>'pecas.editar','uses'=>'PecasController@editar']);
Route::put('assistencia/estoque/atualizar_peca/{id}',['as'=>'pecas.atualizar','uses'=>'PecasController@atualizar']);
Route::get('assistencia/estoque/deletar_peca/{id}',['as'=>'pecas.deletar','uses'=>'PecasController@deletar']);

Route::get('assistencia/estoque/cadastrar_servico',['as'=>'servicos.cadastrar','uses'=>'ServicosController@cadastrar']);
Route::post('assistencia/estoque/salvar_servico',['as'=>'servicos.salvar','uses'=>'ServicosController@salvar']);
Route::get('assistencia/estoque/localizar_servico',['as'=>'servicos.localizar','uses'=>'ServicosController@localizar']);
Route::get('assistencia/estoque/editar_servico/{id}',['as'=>'servicos.editar','uses'=>'ServicosController@editar']);
Route::put('assistencia/atualizar_servico/{id}',['as'=>'servicos.atualizar','uses'=>'ServicosController@atualizar']);
Route::get('assistencia/deletar_servico/{id}',['as'=>'servicos.deletar','uses'=>'ServicosController@deletar']);


Route::get('assistencia/concertos',['as'=>'concertos.index','uses'=>'ConcertoController@index']);



Route::get('assistencia/pagamento',['as'=>'pagamento.index','uses'=>'PagamentoController@index']);
