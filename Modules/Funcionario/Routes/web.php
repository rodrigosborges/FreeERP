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
    
    
    Route::get('funcionario/atestado/{id}', 'FuncionarioController@CreateAtestado');
    Route::post('funcionario/storeAtestado', 'FuncionarioController@storeAtestado');
    
    Route::get('funcionario/listaHistorico/{id}', 'FuncionarioController@listaHistorico');

    //Rotas do demissão
    Route::get('funcionario/demissao/{id}', 'FuncionarioController@demissao');
    Route::post('storeDemissao', 'FuncionarioController@storeDemissao');
    Route::get('funcionario/showDemissao/{id}', 'FuncionarioController@showDemissao');
    Route::get('destroyDemissao/{id}', 'FuncionarioController@destroyDemissao');
    
    //Rotas do FeriasController
    Route::get('ferias/editarFerias/{id}','FeriasController@edit');
    Route::get('ferias/{id}/show', 'FeriasController@show');
    Route::get('ferias/indexRelatorio', 'FeriasController@indexRelatorio');
    Route::post('ferias/listRelatorio', 'FeriasController@listRelatorio');

    Route::get('pagamento/listar/{id}','PagamentoController@listar');
    Route::get('pagamento/novoPagamento/{id}','PagamentoController@novoPagamento');
    Route::get('pagamento/{id}/show', 'PagamentoController@show');

    Route::resource('controleFerias', 'ControleFeriasController');
    Route::resource('ferias', 'FeriasController');
    //Fim das rotas

    Route::resource('funcionario', 'FuncionarioController');
    Route::resource('cargo', 'CargoController');

    //rotas de frequencia
    Route::get('frequencia/{id}', 'FrequenciaController@index');
    Route::post('frequencia/{id}/horasdiarias', 'FrequenciaController@horasdiarias');
    Route::get('frequencia/{id}/pdf/{ano}/{mes}', 'FrequenciaController@pdf');
    Route::get('frequencia/{id}/xls/{ano}/{mes}', 'FrequenciaController@xls');
    Route::get('frequencia/{id}/edit/{ano}/{mes}', 'FrequenciaController@edit');
    Route::put('frequencia/{id}/update/{ano}/{mes}', 'FrequenciaController@update');

    //rotas de logs
    Route::get('logs', 'LogController@index');
    Route::get('logs/list', 'LogController@list');

    //Rotas Pagamento
    
    Route::resource('pagamento', 'PagamentoController');
    
   



});
//Rotas AJAX
Route::post('buscacargos','PagamentoController@buscaCargo');
Route::post('buscasalario','PagamentoController@buscaSalario');