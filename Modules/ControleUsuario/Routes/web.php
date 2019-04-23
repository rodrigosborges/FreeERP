<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::prefix('controleusuario')->group(function() {
    // rota é composta por: /caminho, ClasseController@nomeMétodo
    Route::get('/', 'UsuarioController@index');
    Route::get('/autenticacao', 'UsuarioController@autenticacao');
    Route::get('/consulta', 'UsuarioController@consulta');

});
