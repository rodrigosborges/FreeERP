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
	Route::get('mensagem/enviarMensagem/{id}', 'MensagemController@enviarMensagem');
	Route::get('candidato/novo/{id}', 'CandidatoController@novo');
	Route::get('candidato/addEtapa/{id}', 'CandidatoController@addEtapa');
	Route::post('candidato/addEtapa/', 'CandidatoController@inserirEtapa');
	Route::put('candidato/addEtapa/', 'CandidatoController@inserirEtapa');
	
	Route::get('categoria/{id}/restore', 'CategoriaController@restore');
	Route::get('cargo/{id}/restore', 'CargoController@restore');
	Route::get('vaga/{id}/restore', 'VagaController@restore');
	Route::get('etapa/{id}/restore', 'EtapaController@restore');
	Route::get('candidato/{id}/restore', 'CandidatoController@restore');
	
	
	
	
	Route::resource('vaga', 'VagaController');
	Route::resource('candidato', 'CandidatoController');
	Route::resource('mensagem', 'MensagemController');
	Route::resource('cargo', 'CargoController');
	Route::resource('categoria', 'CategoriaController');
	Route::resource('etapa', 'EtapaController');

	
});