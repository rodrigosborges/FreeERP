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

    Route::get('/processo', 'ProcessoController@index');
    Route::get('/processo/create', 'ProcessoController@create');
    Route::post('/processo/store', 'ProcessoController@store');
    Route::get('/processo/{id}/edit', 'ProcessoController@edit');
    Route::put('/processo/{id}', 'ProcessoController@update');
    Route::delete('/processo/{id}', 'ProcessoController@destroy');
    Route::post('/processo/ajax/search', 'ProcessoController@search');

    Route::get('/avaliacao', 'AvaliacaoController@index');

    Route::get('/questao', 'QuestaoController@index');
    Route::get('/questao/create', 'QuestaoController@create');
    Route::post('/questao/store', 'QuestaoController@store');
    Route::get('/questao/{id}/edit', 'QuestaoController@edit');
    Route::put('/questao/{id}', 'QuestaoController@update');
    Route::delete('/questao/{id}', 'QuestaoController@destroy');
    Route::post('/questao/ajax/search', 'QuestaoController@search');
    
    Route::get('/categoria', 'CategoriaController@index');
    
    Route::get('/relatorio', 'RelatorioController@index');
});
