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
	Route::get('pdf', 'OrdemServicoController@pdf')->name('os.pdf');
	Route::resource('gerente', 'GerenteController');
	Route::resource('os', 'OrdemServicoController');
	Route::resource('tecnico', 'TecnicoController');
	Route::resource('solicitante', 'SolicitanteController');
	Route::resource('problema', 'ProblemaController');
	
});
