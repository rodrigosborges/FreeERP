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

<<<<<<< HEAD
=======
Route::prefix('estoque')->group(function() {
    Route::get('/', 'EstoqueController@index');
    route::resource('produto/categoria', 'CategoriaController');
});
>>>>>>> de80a9ab8250f2bd1a6d4784ed9a731b6c88877c

Route::resource('/produto','ProdutoController');
Route::resource('/produto/unidade', 'UnidadeProdutoController');