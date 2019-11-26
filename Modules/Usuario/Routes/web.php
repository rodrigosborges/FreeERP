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
Route::get('/', 'LoginController@index')->name('login');
Route::post('logar', 'LoginController@authenticate');
Route::get('logout', 'LoginController@logoutUsuario');
Route::get('/esqueciSenha', 'auth\ForgotPasswordController@esqueceu');
Route::post('/esqueciSenha', 'auth\ForgotPasswordController@recuperarSenha');
Route::get('/recuperarSenha', 'auth\ForgotPasswordController@resetarSenha');
Route::put('/recuperarSenha', 'auth\ForgotPasswordController@trocarSenhaUpdate');

Route::prefix('usuario')->group(function() {
    //Trocar Senha
    Route::get('{id}/trocarSenha', 'UsuarioController@trocarSenha')->middleware('auth');
    Route::put('{id}/trocarSenha', 'UsuarioController@trocarSenhaUpdate')->middleware('auth');
    // Cadastrar
    Route::get('/cadastrar', 'UsuarioController@create')->middleware('auth');
    Route::post('/', 'UsuarioController@store')->middleware('auth');
    // Listar
    Route::get('/', 'UsuarioController@index')->middleware('auth');
    // Atualizar
    Route::get('/{id}/edit', 'UsuarioController@edit')->middleware('auth');
    Route::put('/{id}', 'UsuarioController@update')->middleware('auth');
    // Deletar
    Route::delete('/{id}', 'UsuarioController@destroy')->middleware('auth');
    // Restaurar
    Route::put('{id}/restore/', 'UsuarioController@restore')->middleware('auth');

    Route::get('/check-unique/{id?}' ,'UsuarioController@isUnique')->middleware('auth');
});

// Módulo
Route::prefix('modulo')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'ModuloController@create');
    Route::post('/', 'ModuloController@store');
    // Listar
    Route::get('/', 'ModuloController@index');
    // Route::get('/{args}', 'ModuloController@index');
    // Atualizar
    Route::get('/{id}/edit', 'ModuloController@edit');
    Route::put('/{id}', 'ModuloController@update');
    // Deletar
    Route::delete('/{id}', 'ModuloController@destroy');
    // Restaurar
    Route::put('/{id}/restore', 'ModuloController@restore');

    
    Route::get('/check-unique/{id?}' ,'ModuloController@isUnique')->middleware('auth');
});
// Papéis
Route::prefix('papel')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'PapelController@create')->middleware('auth');
    Route::post('/', 'PapelController@store')->middleware('auth');
    // Listar
    Route::get('/', 'PapelController@index')->middleware('auth');
    // Atualizar
    Route::get('/{id}/edit', 'PapelController@edit')->middleware('auth');
    Route::put('/{id}', 'PapelController@update')->middleware('auth');
    // Deletar
    Route::delete('/{id}', 'PapelController@destroy')->middleware('auth');
    // Restaurar
    Route::put('/restore/{id}', 'PapelController@restore')->middleware('auth');
    //Buscar
    //Route::get('/search/{nome}', 'PapelController@search')->middleware('auth');

    
    Route::get('/check-unique/{id?}' ,'PapelController@isUnique')->middleware('auth');
});