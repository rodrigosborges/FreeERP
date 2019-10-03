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
Route::get('/calendario/agendas/compartilhamentos', 'CalendarioController@compartilhamentos')->name('compartilhamentos.index');

Route::get('/calendario/agendas/criar', 'AgendaController@criarOuEditar')->name('agendas.criar');
Route::get('/calendario/agendas/{agenda}', 'AgendaController@criarOuEditar')->name('agendas.editar');
Route::put('/calendario/agendas/{agenda}', 'AgendaController@atualizar')->name('agendas.atualizar');
Route::patch('/calendario/agendas/{agenda}', 'AgendaController@restaurar')->name('agendas.restaurar');
Route::post('/calendario/agendas', 'AgendaController@salvar')->name('agendas.salvar');
Route::get('/calendario/agendas/{agenda}/eventos', 'AgendaController@eventos')->name('agendas.eventos.index');
Route::delete('/calendario/agendas/{agenda}', 'AgendaController@deletar')->name('agendas.deletar');
Route::get('/calendario/agendas/compartilhamentos/{compartilhamento}/aprovar', 'AgendaController@aprovar_compartilhamento')->name('compartilhamentos.aprovar');
Route::get('/calendario/agendas/compartilhamentos/{compartilhamento}/negar', 'AgendaController@negar_compartilhamento')->name('compartilhamentos.negar');
Route::get('/calendario/agendas/compartilhamentos/{compartilhamento}/revogar', 'AgendaController@revogar_aprovacao')->name('compartilhamentos.revogar');

Route::get('/calendario/agendas/eventos/criar', 'EventoController@criarOuEditar')->name('eventos.criar');
Route::get('/calendario/agendas/eventos/{evento}', 'EventoController@criarOuEditar')->name('eventos.editar');
Route::put('/calendario/agendas/eventos/{evento}', 'EventoController@atualizar')->name('eventos.atualizar');
Route::post('/calendario/agendas/eventos', 'EventoController@salvar')->name('eventos.salvar');
Route::delete('/calendario/agendas/eventos/{evento}', 'EventoController@deletar')->name('eventos.deletar');

