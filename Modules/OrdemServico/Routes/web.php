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
Route::prefix('ordemservico')->group(function() {
	Route::get('os/pdf', 'OrdemServicoController@pdf');
	Route::resource('os', 'OrdemServicoController');
	Route::resource('tecnico', 'TecnicoController');
	
});
