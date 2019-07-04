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

Route::prefix('calendario')->group(function() {
    Route::get('/', 'CalendarioController@index')->name('calendario.index');
    Route::prefix('agendas')->group(function(){
        Route::post('/', 'AgendaController@salvar')->name('agendas.salvar');
        Route::get('criar', 'AgendaController@criar')->name('agendas.criar');
        Route::prefix('eventos')->group(function (){
            Route::get('/', 'AgendaController@eventos')->name('eventos.index');
            Route::post('/', 'EventoController@salvar')->name('eventos.salvar');
        });
    });
});
