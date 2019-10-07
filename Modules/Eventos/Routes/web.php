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
Route::get('/eventos/pessoas', 'PessoasController@index')->name('eventos.pessoas');
Route::any('/eventos/pessoas/exibir', 'PessoasController@exibir')->name('pessoas.exibir');
Route::post('/eventos/pessoas/cadastrar', 'PessoasController@cadastrar')->name('pessoas.cadastrar');