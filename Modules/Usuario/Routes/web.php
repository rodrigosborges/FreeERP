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

Route::prefix('usuario')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'UsuarioController@create');
    Route::post('/', 'UsuarioController@store');
    // Listar
    Route::get('/', 'UsuarioController@index');
    // Atualizar
    Route::get('/edit/{id}', 'UsuarioController@edit');
    Route::put('/{id}', 'UsuarioController@update');
    // Deletar
    Route::delete('/{id}', 'UsuarioController@destroy');
    // Restaurar
    Route::put('/restore/{id}', 'UsuarioController@restore');
});

// Módulo
Route::prefix('modulo')->group(function() {
    // Cadastrar
    Route::get('/cadastrar', 'ModuloController@create');
    Route::post('/', 'ModuloController@store');
    // Listar
    Route::get('/', 'ModuloController@index');
    // Atualizar
    Route::get('/edit/{id}', 'ModuloController@edit');
    Route::put('/{id}', 'ModuloController@update');
    // Deletar
    Route::delete('/{id}', 'ModuloController@destroy');
});