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

use Modules\OrdemServico\Http\Controllers\OrdemServicoController;

Route::prefix('ordemservico')->name('modulo.')->group(function() {
	Route::get('/','AcompanhamentoController@acompanharOS')->name('os.acompanharOS');
	Route::post('/acompanhamento','AcompanhamentoController@linhaTempo')->name('os.linhaTempo');
	Route::get('os/ordensconcluidas', 'OrdemServicoController@ordensFinalizadas')->middleware('auth')->name('os.finalizadas');
	Route::get('pdf/{id}', 'OrdemServicoController@pdf')->middleware('auth')->name('os.pdf');
	Route::get('cidades/showJson/{idEstado}','CidadeController@showJson')->middleware('auth');;	
	Route::get('status/create','StatusController@create')->middleware('auth')->name('status.create');
	Route::post('status/store','StatusController@store')->middleware('auth')->name('status.store');
	Route::post('os/status/{id}/updateStatus','StatusController@updateStatus')->middleware('auth')->name('os.update.status');
	Route::get('os/status/{id}/showStatusOS','StatusController@showStatusOS')->middleware('auth');
	Route::post('os/{idOS}/atribuirTecnico','OrdemServicoController@atribuirTecnico')->middleware('auth');
	Route::get('os/{idOS}/showOS','OrdemServicoController@showOS')->middleware('auth');
	Route::get('os/{marca}/problemasMarca', 'OrdemServicoController@problemasMarca')->middleware('auth');
	Route::post('prioridade/{id}/update', 'OrdemServicoController@updatePrioridade')->middleware('auth');
	Route::get("aparelho/showAparelho",'OrdemServicoController@showAparelho');
	Route::get("problema/showProblemas",'OrdemServicoController@showProblemas');

	Route::get("solicitante/showSolicitante",'SolicitanteController@show');
	Route::get('painel/problema', 'PainelTecnicoController@listarProblemas')->middleware('auth')->name('tecnico.painel.problemas');
	Route::get('painel/problema/{id}/solucoes', 'PainelTecnicoController@listarSolucoes')->middleware('auth')->name('tecnico.painel.problemas.solucoes');
	Route::get('painel/ordensDisponiveis','PainelTecnicoController@ordensDisponiveis')->middleware('auth')->name('tecnico.painel.ordens_disponiveis');
	Route::get('painel/', 'PainelTecnicoController@index')->middleware('auth')->name('tecnico.painel.index');
	Route::get('painel/minhasOs', 'PainelTecnicoController@ordensAtivas')->middleware('auth')->name('tecnico.painel.minhasOs');
	Route::get('painel/{idOS}/pegarResponsabilidade', 'PainelTecnicoController@pegarResponsabilidade')->middleware('auth')->name('tecnico.painel.pegarResponsabilidade');
	
	Route::post('solucao/{idOS}/store','SolucaoController@store')->middleware('auth')->name('solucao.store');

	Route::resource('os', 'OrdemServicoController')->middleware('auth');
	Route::resource('solicitante', 'SolicitanteController')->middleware('auth');

	
});
