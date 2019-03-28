<?php


//Módulo de Compras
Route::prefix('compra')->group(function() {
	Route::resource('itemCompra', 'ItemCompraController');
	Route::resource('Pedido', 'PedidoController');
});