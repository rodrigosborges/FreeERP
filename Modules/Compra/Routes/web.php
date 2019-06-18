<?php


//Módulo de Compras
Route::prefix('compra')->group(function() {

	//Rotas que não são Resource
	Route::get('pedido/pedidosDisponiveis',  'PedidoController@pedidos_disponiveis');
	Route::get('pedido/{id}/solicitarOrcamento', 'PedidoController@solicitar_orcamento');
	Route::put('pedido/enviarEmail', 'PedidoController@enviar_email');



	Route::resource('itemCompra', 'ItemCompraController');
	Route::resource('pedido', 'PedidoController');
	Route::resource('fornecedor', 'FornecedorController');
	Route::resource('orcamento', 'OrcamentoController');


});
