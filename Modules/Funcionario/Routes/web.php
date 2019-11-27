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



Route::prefix('funcionario')->group(function() {
    Route::get('funcionario/list/{status}', 'FuncionarioController@list')->middleware('auth');
    Route::get('cargo/search/{valor}', 'CargoController@search')->middleware('auth');
    Route::get('cargo/list/{status}', 'CargoController@list')->middleware('auth');
    Route::get('funcionario/ficha/{id}', 'FuncionarioController@ficha')->middleware('auth');
    Route::get('get-cidades/{uf}', 'FuncionarioController@getCidades')->middleware('auth');
    Route::get('funcionario/editCargo/{id}','FuncionarioController@editCargo')->middleware('auth');
    Route::post('funcionario/editCargo/{id}','FuncionarioController@updateCargo')->middleware('auth');
    Route::get('funcionario/downloadComprovante/{id}','FuncionarioController@downloadComprovante')->middleware('auth');
    Route::get('ferias/controleFerias/{id}','ControleFeriasController@controleFerias')->middleware('auth');
    Route::get('ferias/listar/{id}','FeriasController@listar')->middleware('auth');
    
    
    Route::get('funcionario/atestado/{id}', 'FuncionarioController@CreateAtestado')->middleware('auth');
    Route::post('funcionario/storeAtestado', 'FuncionarioController@storeAtestado')->middleware('auth');
    
    Route::get('funcionario/listaHistorico/{id}', 'FuncionarioController@listaHistorico')->middleware('auth');

    //Rotas do demissão
    Route::get('funcionario/demissao/{id}', 'FuncionarioController@demissao')->middleware('auth');
    Route::post('storeDemissao', 'FuncionarioController@storeDemissao')->middleware('auth');
    Route::get('funcionario/showDemissao/{id}', 'FuncionarioController@showDemissao')->middleware('auth');
    Route::get('destroyDemissao/{id}', 'FuncionarioController@destroyDemissao')->middleware('auth');
    
    //Rotas do FeriasController
    Route::get('ferias/editarFerias/{id}','FeriasController@edit')->middleware('auth');
    Route::get('ferias/{id}/show', 'FeriasController@show')->middleware('auth');
    Route::get('ferias/indexRelatorio', 'FeriasController@indexRelatorio')->middleware('auth');
    Route::post('ferias/listRelatorio', 'FeriasController@listRelatorio')->middleware('auth');

    Route::get('pagamento/listar/{id}','PagamentoController@listar')->middleware('auth');
    Route::get('pagamento/novoPagamento/{id}','PagamentoController@novoPagamento')->middleware('auth');
    Route::get('pagamento/{id}/show', 'PagamentoController@show')->middleware('auth');

    Route::resource('controleFerias', 'ControleFeriasController')->middleware('auth');
    Route::resource('ferias', 'FeriasController')->middleware('auth');
    //Fim das rotas

    Route::resource('funcionario', 'FuncionarioController');
    Route::resource('cargo', 'CargoController');
    //Rotas Pagamento
    
    Route::resource('pagamento', 'PagamentoController');
    
   



});
//Rotas AJAX
Route::post('buscacargos','PagamentoController@buscaCargo');
Route::post('buscasalario','PagamentoController@buscaSalario');