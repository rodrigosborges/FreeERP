<?php

Route::prefix('protocolos')->group(function() {

    Route::get('/protocolos_interessados', function() {
        return Modules\Protocolos\Entities\Protocolo::findOrFail(1)->interessado;
    });

    Route::get('/chart', 'ProtocolosController@chart');
    Route::get('/cadastrar', 'UsuarioController@create');
    Route::post('/envia', 'UsuarioController@store');
    
    Route::get('protocolos/login', 'LoginController@index')->name('login');
    Route::post('protocolos/logar', 'LoginController@authenticate');
    Route::get('protocolos/logout', 'LoginController@logoutUsuario');

    Route::get('protocolos/list/{status}', 'ProtocolosController@testList');
    Route::get('protocolos/receber/{id}', 'ProtocolosController@receber');
    Route::get('protocolos/encaminhar/{id}', 'ProtocolosController@encaminhar');
    Route::post('protocolos/{id}', 'ProtocolosController@salvarEncaminhamento');
    Route::get('protocolos/list/{status}', 'ProtocolosController@list');
    Route::post('busca', 'ProtocolosController@fetch');
    Route::post('buscaApensado', 'ProtocolosController@fetchApensado');
    Route::get('protocolos/acompanhar/{id}', 'ProtocolosController@acompanhar');
    Route::post('protocolos/acompanhar/{id}', 'ProtocolosController@salvarDocumento');
    Route::get('protocolos/download/{id}', 'ProtocolosController@download');
    Route::post('salvarApensado/{id}', 'ProtocolosController@salvarApensado');
    Route::get('teste/{id}', 'ProtocolosController@teste');
    Route::resource('protocolos', 'ProtocolosController')->middleware('auth');



});