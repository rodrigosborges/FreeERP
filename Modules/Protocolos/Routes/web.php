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


//Módulo de Protocolos
Route::prefix('protocolos')->group(function() {

    Route::get('/cadastrar', 'UsuarioController@create');
    Route::post('/envia', 'UsuarioController@store');
    
    Route::get('protocolos/login', 'LoginController@index')->name('login');
    Route::post('protocolos/logar', 'LoginController@authenticate');
    Route::get('protocolos/logout', 'LoginController@logoutUsuario');

    Route::get('protocolos/list/{status}', 'ProtocolosController@list');
    Route::post('busca', 'ProtocolosController@fetch');

    Route::resource('protocolos', 'ProtocolosController')->middleware('auth');
 
});