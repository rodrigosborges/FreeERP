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
Route::get('/eventos', 'EventosController@index')->name('eventos.index');
Route::get('/eventos/exibir', 'EventosController@exibir')->name('eventos.exibir');
Route::get('/eventos/inscricoes', 'EventosController@inscricoes')->name('eventos.inscricoes');
Route::get('/eventos/detalha/{id}', 'EventosController@detalhar')->name('eventos.detalhar');
Route::post('/eventos/cadastrar', 'EventosController@cadastrar')->name('eventos.cadastrar');
Route::post('/eventos/editar', 'EventosController@editar')->name('eventos.editar');
Route::get('/eventos/inscricao/{programacao}', 'EventosController@inscricao')->name('eventos.inscricao');
Route::delete('/eventos/excluir', 'EventosController@excluir')->name('eventos.excluir');

Route::get('/eventos/programacao/{id}', 'ProgramacaoController@exibir')->name('programacao.exibir');
Route::post('/eventos/programacao/{id}/cadastrar', 'ProgramacaoController@cadastrar')->name('programacao.cadastrar');
Route::post('/eventos/programacao/{id}/editar', 'ProgramacaoController@editar')->name('programacao.editar');
Route::delete('/eventos/programacao/excluir', 'ProgramacaoController@excluir')->name('programacao.excluir');

Route::get('/eventos/pessoas', 'PessoasController@index')->name('eventos.pessoas');
Route::any('/eventos/pessoas/exibir', 'PessoasController@exibir')->name('pessoas.exibir');
//Route::post('/eventos/pessoas/cadastrar', 'PessoasController@cadastrar')->name('pessoas.cadastrar');
//Route::post('/eventos/pessoas/editar', 'PessoasController@editar')->name('pessoas.editar');
Route::post('/eventos/pessoas/excluir', 'PessoasController@excluir')->name('pessoas.excluir');

Route::get('/eventos/get-cidades/{idEstado}', 'CidadeController@getCidades');
Route::get('/eventos/get-atividade/{idAtividade}', 'ProgramacaoController@getAtividade');
Route::get('/eventos/get-evento/{id}', 'EventosController@getEvento');
Route::get('/eventos/get-data/', 'EventosController@getData');
Route::get('/eventos/pessoas/get-pessoa/{email}', 'PessoasController@getPessoa');

Route::get('/pdf/{id}', 'EventosController@certificados')->name('gerar.certificados');