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

Route::prefix('avaliacaodesempenho')->group(function() {

    Route::get('/', 'DashboardController@index');

    Route::get('/processos', 'ProcessoController@index');
    Route::get('/processos/create', 'ProcessoController@create');
    Route::post('/processos/store', 'ProcessoController@store');
    Route::get('/processos/edit/{id}', 'ProcessoController@edit');
    Route::put('/processos/{id}', 'ProcessoController@update');
    // Route::delete('/processos/{id}', 'ProcessoController@delete');
    Route::get('/processos/delete/{id}', 'ProcessoController@delete');
    Route::get('/processos/restore/{id}', 'ProcessoController@restore');
    Route::post('/processos/ajax/search', 'ProcessoController@search');

    Route::get('/avaliacoes', 'AvaliacaoController@index');

    Route::get('/questoes', 'QuestaoController@index');
    
    Route::get('/categorias', 'CategoriaController@index');
    
    Route::get('/relatorios', 'RelatorioController@index');
});
