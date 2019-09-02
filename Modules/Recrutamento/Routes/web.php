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

//Módulo de Recrutamento
Route::prefix('recrutamento')->group(function() {
	
	Route::get('vagasDisponiveis', 'VagaController@vagasDisponiveis');
	Route::get('vaga/candidatos/{id}', 'VagaController@candidatos');
	Route::get('entrevista/marcarEntrevista/{id}', 'EntrevistaController@marcarEntrevista');
	Route::resource('vaga', 'VagaController');
	Route::resource('candidato', 'CandidatoController');
	Route::resource('entrevista', 'EntrevistaController');

	
});