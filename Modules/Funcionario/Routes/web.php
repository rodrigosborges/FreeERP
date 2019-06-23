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

    Route::resource('funcionario', 'FuncionarioController');
    Route::resource('cargo', 'CargoController');
});
