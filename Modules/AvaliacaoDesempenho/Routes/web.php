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

    //AVALIAÇÃO ROUTES
    Route::get('/avaliacao', 'AvaliacaoController@index');
    Route::get('/avaliacao/{id}/show', 'AvaliacaoController@show');
    Route::get('/avaliacao/create', 'AvaliacaoController@create');
    Route::post('/avaliacao/store', 'AvaliacaoController@store');
    Route::get('/avaliacao/{id}/edit', 'AvaliacaoController@edit');
    Route::put('/avaliacao/{id}', 'AvaliacaoController@update');
    Route::delete('/avaliacao/{id}', 'AvaliacaoController@destroy');

    // REALIZAR AVALIAÇÃO ROUTES
    Route::get('/avaliacao/responder', 'AvaliacaoRespostaController@index');

    Route::get('/avaliacao/recuperar', 'AvaliacaoRespostaController@recuperar');
    Route::post('/avaliacao/reenviar', 'AvaliacaoRespostaController@reenviar');
    
    Route::post('/avaliacao/responder', 'AvaliacaoRespostaController@responder');
    Route::post('/avaliacao/respostas', 'AvaliacaoRespostaController@resposta');

    // QUESTÃO ROUTES
    Route::get('/questao', 'QuestaoController@index');
    Route::get('/questao/create', 'QuestaoController@create');
    Route::post('/questao/store', 'QuestaoController@store');
    Route::get('/questao/{id}/edit', 'QuestaoController@edit');
    Route::put('/questao/{id}', 'QuestaoController@update');
    Route::delete('/questao/{id}', 'QuestaoController@destroy');
    
    // CATEGORIA ROUTES
    Route::get('/categoria', 'CategoriaController@index');
    Route::get('/categoria/create', 'CategoriaController@create');
    Route::post('/categoria/store', 'CategoriaController@store');
    Route::get('/categoria/{id}/edit', 'CategoriaController@edit');
    Route::put('/categoria/{id}', 'CategoriaController@update');
    Route::delete('/categoria/{id}', 'CategoriaController@destroy');
    
    // SETOR ROUTES
    Route::get('/setor', 'SetorController@index');
    Route::get('/setor/create', 'SetorController@create');
    Route::post('/setor/store', 'SetorController@store');
    Route::get('/setor/{id}/edit', 'SetorController@edit');
    Route::put('/setor/{id}', 'SetorController@update');
    Route::delete('/setor/{id}', 'SetorController@destroy');

    // RELATORIO ROUTES
    Route::get('/relatorio', 'RelatorioController@index');
    Route::post('/relatorio/avaliacoes', 'RelatorioController@getAvaliacoes');
    Route::post('/relatorio/individual', 'RelatorioController@individual');

    Route::get('/relatorio/individual/{tipo}/{id}/show', 'RelatorioController@showIndividual');
    Route::get('/relatorio/gestor/{id}/show', 'RelatorioController@showGestor');

    Route::post('/ajax/search', 'BaseController@search');

    Route::post('/ajax/field', 'BaseController@search_field');

    Route::get('/cron/avisos', 'CronController@avisos');
});
