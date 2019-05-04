<?php


//Módulo de Compras
Route::prefix('compra')->group(function() {
	Route::resource('itemCompra', 'ItemCompraController');
	Route::resource('pedido', 'PedidoController');
	Route::resource('fornecedor', 'FornecedorController');
	Route::get('pedido/pedidosDisponiveis', 'PedidoController@pedidos_disponiveis');
	Route::get('pedido/{id}/gerarOrcamento', 'PedidoController@gerar_orcamento');

	


});
