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

Route::get('/calendario', 'CalendarioController@index')->name('calendario.index');

Route::post('/calendario/agendas', 'AgendaController@salvar')->name('agendas.salvar');
Route::get('/calendario/agendas/criar', 'AgendaController@criar')->name('agendas.criar');
Route::get('/calendario/agendas/eventos', 'AgendaController@eventos')->name('eventos.index');

Route::post('/calendario/agendas/eventos', 'EventoController@salvar')->name('eventos.salvar');