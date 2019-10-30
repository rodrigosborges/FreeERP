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
Route::get('/calendario/agendas', 'AgendaController@agendas')->name('agendas.index');
Route::get('/calendario/agendas/eventos', 'EventoController@eventos')->name('eventos.index');
Route::get('/calendario/compartilhamentos', 'AgendaController@compartilhamentos')->name('compartilhamentos.index');
Route::get('/calendario/convites', 'EventoController@convites')->name('convites.index');

Route::get('/calendario/agendas/criar', 'AgendaController@criarOuEditar')->name('agendas.criar');
Route::get('/calendario/agendas/{agenda}', 'AgendaController@criarOuEditar')->name('agendas.editar');
Route::put('/calendario/agendas/{agenda}', 'AgendaController@atualizar')->name('agendas.atualizar');
Route::patch('/calendario/agendas/{agenda}', 'AgendaController@restaurar')->name('agendas.restaurar');
Route::post('/calendario/agendas', 'AgendaController@salvar')->name('agendas.salvar');
Route::get('/calendario/agendas/{agenda}/eventos', 'AgendaController@eventos')->name('agendas.eventos.index');
Route::delete('/calendario/agendas/{agenda}', 'AgendaController@deletar')->name('agendas.deletar');

Route::get('/calendario/convites/{convite}/aceitar', 'EventoController@aceitar_convite')->name('convites.aceitar');

Route::get('/calendario/compartilhamentos/{compartilhamento}/aprovar', 'AgendaController@aprovar_compartilhamento')->name('compartilhamentos.aprovar');
Route::get('/calendario/compartilhamentos/{compartilhamento}/negar', 'AgendaController@negar_compartilhamento')->name('compartilhamentos.negar');
Route::get('/calendario/compartilhamentos/{compartilhamento}/revogar', 'AgendaController@revogar_aprovacao')->name('compartilhamentos.revogar');

Route::get('/calendario/agendas/eventos/criar', 'EventoController@criarOuEditar')->name('eventos.criar');
Route::get('/calendario/agendas/eventos/{evento}', 'EventoController@criarOuEditar')->name('eventos.editar');
Route::get('/calendario/agendas/eventos/{evento}/duplicar', 'EventoController@criarOuEditar')->name('eventos.duplicar');
Route::put('/calendario/agendas/eventos/{evento}', 'EventoController@atualizar')->name('eventos.atualizar');
Route::post('/calendario/agendas/eventos', 'EventoController@salvar')->name('eventos.salvar');
Route::get('/calendario/agendas/eventos/{evento}/deletar', 'EventoController@deletar')->name('eventos.deletar');

Route::get('/calendario/notificar', 'EventoController@notificar')->name('eventos.notificar');

