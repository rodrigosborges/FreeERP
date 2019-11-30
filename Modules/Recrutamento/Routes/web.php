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
	Route::get('/', 'VagaController@index');
	Route::get('vagasDisponiveis', 'VagaController@vagasDisponiveis');
	Route::get('vaga/candidatos/{id}', 'VagaController@candidatos')->middleware('auth');
	Route::get('mensagem/enviarMensagem/{id}', 'MensagemController@enviarMensagem')->middleware('auth');
	Route::get('mensagem/malaDireta', 'MensagemController@malaDireta')->middleware('auth');
	Route::get('candidato/novo/{id}', 'CandidatoController@novo');
	Route::get('candidato/addEtapa/{id}', 'CandidatoController@addEtapa')->middleware('auth');
	Route::put('candidato/addEtapa/', 'CandidatoController@inserirEtapa')->middleware('auth');
	Route::get('categoria/{id}/restore', 'CategoriaController@restore')->middleware('auth');
	Route::get('cargo/{id}/restore', 'CargoController@restore')->middleware('auth');
	Route::get('vaga/{id}/restore', 'VagaController@restore')->middleware('auth');
	Route::get('etapa/{id}/restore', 'EtapaController@restore')->middleware('auth');
	Route::get('beneficio/{id}/restore', 'BeneficioController@restore')->middleware('auth');
	Route::get('candidato/{id}/restore', 'CandidatoController@restore')->middleware('auth');
	
	Route::post('candidato/addEtapa/', 'CandidatoController@inserirEtapa')->middleware('auth');
	Route::post('mensagem/enviarEmails', 'MensagemController@enviarEmails')->middleware('auth');

	Route::resource('vaga', 'VagaController');
	Route::resource('candidato', 'CandidatoController');
	Route::resource('mensagem', 'MensagemController')->middleware('auth');
	Route::resource('cargo', 'CargoController')->middleware('auth');
	Route::resource('categoria', 'CategoriaController')->middleware('auth');
	Route::resource('etapa', 'EtapaController')->middleware('auth');
	Route::resource('beneficio', 'BeneficioController')->middleware('auth');

	
});