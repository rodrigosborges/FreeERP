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
Route::get('/', 'LoginController@index');
Route::post('/logar', 'LoginController@authenticate');

Route::prefix('usuario')->group(function() {
    //Trocar Senha
    Route::get('{id}/trocarSenha', 'UsuarioController@trocarSenha');
    Route::put('{id}/trocarSenha', 'UsuarioController@trocarSenhaUpdate');
    // Cadastrar
    Route::get('/cadastrar', 'UsuarioController@create');
    Route::post('/', 'UsuarioController@store');
    // Listar
    Route::get('/', 'UsuarioController@index');
    // Atualizar
    Route::get('/{id}/edit', 'UsuarioController@edit');
    Route::put('/{id}', 'UsuarioController@update');
    // Deletar
    Route::delete('/{id}', 'UsuarioController@destroy');
    // Restaurar
    Route::put('/restore/{id}', 'UsuarioController@restore');

    Route::get('/check-unique', 'UsuarioController@isUnique');
});

// Módulo
Route::prefix('modulo')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'ModuloController@create');
    Route::post('/', 'ModuloController@store');
    // Listar
    Route::get('/', 'ModuloController@index');
    Route::get('/{args}', 'ModuloController@index');
    // Atualizar
    Route::get('/{id}/edit', 'ModuloController@edit');
    Route::put('/{id}', 'ModuloController@update');
    // Deletar
    Route::delete('/{id}', 'ModuloController@destroy');
    // Restaurar
    Route::put('/{id}/restore', 'ModuloController@restore');
});
// Papéis
Route::prefix('papel')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'PapelController@create');
    Route::post('/', 'PapelController@store');
    // Listar
    Route::get('/', 'PapelController@index');
    // Atualizar
    Route::get('/{id}/edit', 'PapelController@edit');
    Route::put('/{id}', 'PapelController@update');
    // Deletar
    Route::delete('/{id}', 'PapelController@destroy');
    // Restaurar
    Route::put('/restore/{id}', 'PapelController@restore');
    //Buscar
    //Route::get('/search/{nome}', 'PapelController@search');
});