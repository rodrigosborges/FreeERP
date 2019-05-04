<?php


//Módulo de Compras
Route::prefix('compra')->group(function() {
	Route::resource('itemCompra', 'ItemCompraController');
	Route::resource('pedido', 'PedidoController');
	Route::resource('fornecedor', 'FornecedorController');
	Route::get('pedidosDisponiveis', 'PedidoController@pedidos_disponiveis');

	


});
