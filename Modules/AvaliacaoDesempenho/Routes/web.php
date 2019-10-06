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

    // DASHBOARD ROUTES
    Route::get('/', 'DashboardController@index');

    // PROCESSO ROUTES
    Route::get('/processo', 'ProcessoController@index');
    Route::get('/processo/create', 'ProcessoController@create');
    Route::post('/processo/store', 'ProcessoController@store');
    Route::get('/processo/{id}/edit', 'ProcessoController@edit');
    Route::put('/processo/{id}', 'ProcessoController@update');
    Route::delete('/processo/{id}', 'ProcessoController@destroy');
    Route::post('/processo/ajax/search', 'ProcessoController@search');

    //AVALIAÇÃO ROUTES
    Route::get('/avaliacao', 'AvaliacaoController@index');
    Route::get('/avaliacao/create', 'AvaliacaoController@create');
    Route::post('/avaliacao/store', 'AvaliacaoController@store');
    Route::get('/avaliacao/{id}/edit', 'AvaliacaoController@edit');
    Route::put('/avaliacao/{id}', 'AvaliacaoController@update');
    Route::delete('/avaliacao/{id}', 'AvaliacaoController@destroy');
    Route::post('/avaliacao/ajax/search', 'AvaliacaoController@search');

    // REALIZAR AVALIAÇÃO ROUTES
    Route::get('/avaliacao/responder', 'AvaliadoController@index');
    Route::post('/avaliacao/responder', 'AvaliadoController@responder');

    // QUESTÃO ROUTES
    Route::get('/questao', 'QuestaoController@index');
    Route::get('/questao/create', 'QuestaoController@create');
    Route::post('/questao/store', 'QuestaoController@store');
    Route::get('/questao/{id}/edit', 'QuestaoController@edit');
    Route::put('/questao/{id}', 'QuestaoController@update');
    Route::delete('/questao/{id}', 'QuestaoController@destroy');
    Route::post('/questao/ajax/search', 'QuestaoController@search');
    
    // CATEGORIA ROUTES
    Route::get('/categoria', 'CategoriaController@index');
    Route::get('/categoria/create', 'CategoriaController@create');
    Route::post('/categoria/store', 'CategoriaController@store');
    Route::get('/categoria/{id}/edit', 'CategoriaController@edit');
    Route::put('/categoria/{id}', 'CategoriaController@update');
    Route::delete('/categoria/{id}', 'CategoriaController@destroy');
    Route::post('/categoria/ajax/search', 'CategoriaController@search');
    
    // SETOR ROUTES
    Route::get('/setor', 'SetorController@index');
    Route::get('/setor/create', 'SetorController@create');
    Route::post('/setor/store', 'SetorController@store');
    Route::get('/setor/{id}/edit', 'SetorController@edit');
    Route::put('/setor/{id}', 'SetorController@update');
    Route::delete('/setor/{id}', 'SetorController@destroy');
    Route::post('/setor/ajax/search', 'SetorController@search');

    // RELATORIO ROUTES
    Route::get('/relatorio', 'RelatorioController@index');
});
