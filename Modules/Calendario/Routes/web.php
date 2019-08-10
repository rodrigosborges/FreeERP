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
Route::get('/calendario/agendas', 'CalendarioController@agendas')->name('agendas.index');
Route::get('/calendario/agendas/eventos', 'CalendarioController@eventos')->name('eventos.index');

Route::get('/calendario/agendas/criar', 'AgendaController@criarOuEditar')->name('agendas.criar');
Route::get('/calendario/agendas/{agenda}', 'AgendaController@criarOuEditar')->name('agendas.editar');
Route::put('/calendario/agendas/{agenda}', 'AgendaController@atualizar')->name('agendas.atualizar');
Route::post('/calendario/agendas', 'AgendaController@salvar')->name('agendas.salvar');
Route::get('/calendario/agendas/{agenda}/eventos', 'AgendaController@eventos')->name('agendas.eventos.index');
Route::delete('/calendario/agendas/{agenda}', 'AgendaController@deletar')->name('agendas.deletar');

Route::post('/calendario/agendas/eventos', 'EventoController@salvar')->name('eventos.salvar');
Route::delete('/calendario/agendas/eventos/{evento}', 'EventoController@deletar')->name('eventos.deletar');
