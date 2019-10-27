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

    Route::get('protocolos/encaminhar/{id}', 'ProtocolosController@encaminhar');
    Route::post('protocolos/{id}', 'ProtocolosController@salvarEncaminhamento');
    Route::get('protocolos/list/{status}', 'ProtocolosController@list');
    Route::post('busca', 'ProtocolosController@fetch');
    Route::post('buscaApensado', 'ProtocolosController@fetchApensado');
    Route::get('protocolos/acompanhar/{id}', 'ProtocolosController@acompanhar');
    Route::post('protocolos/acompanhar/{id}', 'ProtocolosController@salvarDocumento');
    Route::post('protocolos/download', 'ProtocolosController@download');
    Route::post('salvarApensado/{id}', 'ProtocolosController@salvarApensado');
    Route::resource('protocolos', 'ProtocolosController')->middleware('auth');

});