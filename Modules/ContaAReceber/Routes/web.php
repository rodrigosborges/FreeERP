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

Route::prefix('contaareceber')->group(function() {
    
    /* ROTAS CATEGORIAS */
    Route::get('categoria',['as' => 'categoria.index', 'uses' => 'CategoriaController@index']);
    Route::post('categoria/salvar', ['as' => 'categoria.salvar', 'uses' => 'CategoriaController@salvar']);         
    Route::get('deletar_categoria={id}', ['as' => 'categoria.deletar', 'uses' => 'CategoriaController@deletar']);  
    
    /* ROTAS CONTAS A RECEBER */    
    Route::get('/', 'ContaAReceberController@index');
    Route::get('/', ['as' => 'contaareceber', 'uses' => 'ContaAReceberController@index']);    
    Route::post('cadastrar', ['as' => 'conta.cadastrar' , 'uses' => 'ContaAReceberController@cadastrarConta']);
    Route::get('deletar={id}', ['as' => 'conta.deletar', 'uses' => 'ContaAReceberController@deletar']);
    Route::post('filtrar', ['as' => 'conta.filtrar', 'uses' => 'ContaAReceberController@filtrar']);

    /* EDICAO DE CONTAS */
    Route::get('editar/{id}', ['as' => 'conta.editar', 'uses' => 'ContaAReceberController@editar']);    
    Route::post('editar/{id}/salvar', ['as' => 'conta.salvar', 'uses' => 'ContaAReceberController@salvar']);    
    
    /* ROTAS FORMAS DE PAGAMENTO */
    Route::get('formapagamento',['as' => 'formapagamento.index', 'uses' => 'FormaPagamentoController@index']);
    Route::post('formapagamento/salvar', ['as' => 'forma_pagamento.salvar', 'uses' => 'FormaPagamentoController@salvar']);     
    Route::get('deletar_formapg={id}', ['as' => 'forma_pagamento.deletar', 'uses' => 'FormaPagamentoController@deletar']);      
});

