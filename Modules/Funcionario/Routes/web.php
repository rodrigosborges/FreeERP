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
    Route::get('funcionario/list/{status}', 'FuncionarioController@list');
    Route::get('cargo/search/{valor}', 'CargoController@search');
    Route::get('cargo/list/{status}', 'CargoController@list');
    Route::get('funcionario/ficha/{id}', 'FuncionarioController@ficha');
    Route::get('get-cidades/{uf}', 'FuncionarioController@getCidades');
    Route::get('funcionario/editCargo/{id}','FuncionarioController@editCargo');
    Route::post('funcionario/editCargo/{id}','FuncionarioController@updateCargo');
    Route::get('funcionario/downloadComprovante/{id}','FuncionarioController@downloadComprovante');
    Route::get('ferias/controleFerias/{id}','ControleFeriasController@controleFerias');
    Route::get('ferias/listar/{id}','FeriasController@listar');

    //Rotas do FeriasController
    Route::get('ferias/editarFerias/{id}','FeriasController@edit');
    Route::get('ferias/{id}/show', 'FeriasController@show');
    Route::post('funcionario/ferias/{id}', 'FeriasController@update');

    Route::get('pagamento/listar/{id}','PagamentoController@listar');
    Route::get('pagamento/novoPagamento/{id}','PagamentoController@novoPagamento');


    Route::resource('controleFerias', 'ControleFeriasController');
    Route::resource('ferias', 'FeriasController');
    //Fim das rotas

    Route::resource('funcionario', 'FuncionarioController');
    Route::resource('cargo', 'CargoController');
    //Rotas Pagamento
    
    Route::resource('pagamento', 'PagamentoController');
    
   



});
//Rotas AJAX
Route::post('buscacargos','PagamentoController@buscaCargo');
Route::post('buscasalario','PagamentoController@buscaSalario');