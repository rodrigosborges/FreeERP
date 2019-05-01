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
    //rotas de autenticação de usuario
    Route::get('/login', 'UsuarioController@login');
    Route::post('/login',['as'=>'validar.login', 'uses'=>'UsuarioController@validaLogin']);
    Route::get('/dashboard',['as'=>'user.dashboard', 'uses'=>'UsuarioController@index']);
    // rota é composta por: /caminho, ClasseController@nomeMétodo

    Route::get('/', 'UsuarioController@index');
    Route::get('/consulta', 'UsuarioController@consulta');

    Route::post('/salvar',['as'=>'usuario.salvar','uses'=> 'UsuarioController@salvarCadastro']);
    Route::put('/editar/{id}', 'UsuarioController@editar');
    Route::get('/inativar/{id}', 'UsuarioController@inativar');

    Route::post('/listar',['as'=>'usuario.listar','uses'=> 'UsuarioController@buscar']);

});
