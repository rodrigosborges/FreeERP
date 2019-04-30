<?php


//Módulo de Compras
Route::prefix('compra')->group(function() {
	Route::resource('itemCompra', 'ItemCompraController');
	Route::resource('pedido', 'PedidoController');
	Route::resource('fornecedor', 'FornecedorController');
	Route::get('pedidosDisponiveis', 'PedidoController@pedidos_disponiveis');

	


});

Route::get('compra/email',function (){
	Mail::send('teste', ['curso'=>'Eloquent'], function($m){
		$m->from('thofurtado@gmail.com', 'Modulo Compras');
		$m->to('pedrops02@gmail.com');

	});
});