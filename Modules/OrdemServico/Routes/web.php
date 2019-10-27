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

//Módulo de Ordem de servico
Route::prefix('ordemservico')->name('modulo.')->group(function() {
	Route::get('/','AcompanhamentoController@acompanharOS');
	Route::post('/acompanhamento','AcompanhamentoController@linhaTempo')->name('os.linhaTempo');
	Route::get('pdf/{id}', 'OrdemServicoController@pdf')->middleware('auth')->name('os.pdf');
	Route::get('cidades/showJson/{idEstado}','CidadeController@showJson')->middleware('auth');;	
	Route::get('status/create','StatusController@create')->middleware('auth');
	Route::post('status/store','StatusController@store')->middleware('auth');
	Route::post('os/status/{id}/updateStatus','StatusController@updateStatus')->middleware('auth')->name('os.update.status');
	Route::get('os/status/{id}/showStatusOS','StatusController@showStatusOS')->middleware('auth');
	Route::post('prioridade/{id}/update', 'OrdemServicoController@updatePrioridade');

	Route::get('painel/ordensDisponiveis','PainelTecnicoController@ordensDisponiveis')->middleware('auth')->name('tecnico.painel.ordens_disponiveis');
	Route::get('painel/', 'PainelTecnicoController@index')->middleware('auth')->name('tecnico.painel.index');
	Route::get('painel/minhasOs', 'PainelTecnicoController@ordensAtivas')->middleware('auth')->name('tecnico.painel.minhasOs');
	Route::get('painel/{idOS}/pegarResponsabilidade', 'PainelTecnicoController@pegarResponsabilidade')->middleware('auth')->name('tecnico.painel.pegarResponsabilidade');
	
	Route::post('solucao/{idOS}/store','SolucaoController@store')->middleware('auth')->name('solucao.store');

	Route::resource('os', 'OrdemServicoController')->middleware('auth');
	Route::resource('solicitante', 'SolicitanteController')->middleware('auth');

	
});
