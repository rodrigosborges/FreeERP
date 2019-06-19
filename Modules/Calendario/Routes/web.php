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
    Route::get('/', 'CalendarioController@index');
    Route::get('/agendas/criar', 'AgendaController@create')->name('agendas.criar');
    Route::get('/eventos', 'CalendarioController@eventos')->name('eventos');
    Route::post('/eventos/criar', 'EventoController@create')->name('eventos.criar');

});
