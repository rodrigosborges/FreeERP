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
    Route::get('funcionario/search/{valor}', 'FuncionarioController@search');
    Route::get('cargo/search/{valor}', 'CargoController@search');
    Route::get('cargo/list/{status}', 'CargoController@list');

    Route::resource('funcionario', 'FuncionarioController');
    Route::resource('cargo', 'CargoController');
});
