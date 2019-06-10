<?php

use \Modules\ContaAPagar\Http\Controllers\ContaAPagarController;


Route::prefix('contaapagar')->group(function() {
    Route::get('/', 'ContaAPagarController@index');
    Route::get('/', ['as' => 'contaapagar', 'uses' => 'ContaAPagarController@index']);
    Route::get('categoria/{id}', ['as' => 'cat.id', 'uses' => 'ContaAPagarController@filtro']);
    Route::get('deletar/{id}', ['as' => 'conta.deletar', 'uses' => 'ContaAPagarController@deletar']);
    Route::get('editar/{id}', ['as' => 'conta.editar', 'uses' => 'ContaAPagarController@editar']);
    Route::post('editar/pagamento/{id}/salvar', ['as' => 'pagamento.salvar', 'uses' => 'PagamentoController@salvar']);
    Route::post('editar/{id}/salvar', ['as' => 'conta.salvar', 'uses' => 'ContaAPagarController@salvar']);
    Route::get('deletar_categoria={id}', ['as' => 'categoria.deletar', 'uses' => 'CategoriaController@deletar']);    
    
    Route::get('check/teste', ['as' => 'check.status', 'uses' => 'ContaAPagarController@status']);
    Route::post('categoria/salvar', ['as' => 'categoria.salvar', 'uses' => 'CategoriaController@salvar']);
    Route::get('categoria',['as' => 'categoria.index', 'uses' => 'CategoriaController@index']);

    Route::get('conta/novo', ['as' => 'conta.novo' , 'uses' => 'ContaAPagarController@novaConta']);
    Route::post('cadastrar', ['as' => 'conta.cadastrar' , 'uses' => 'ContaAPagarController@cadastrarConta']);
    
    Route::post('filtrar', ['as' => 'conta.filtrar', 'uses' => 'ContaAPagarController@filtrar']);

    Route::get('deletar_pagamento={id}', ['as' => 'pagamento.deletar', 'uses' => 'PagamentoController@deletar']);
    Route::post('adicionar_pagamento/{id}', ['as' => 'pagamento.adicionar', 'uses' => 'PagamentoController@adicionar']);    
});



