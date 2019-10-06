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

Route::prefix('estoquemadeireira')->group(function() {
    Route::get('/', 'EstoqueMadeireiraController@index');

    //ROTA DE PROTUDOS
    Route::resource('/produtos', 'ProdutoController');
   // Route::get('/produtos', 'ProdutoController@index');



    // Route::get('/cadastrooperador', function(){
        
    //     return "ae";
    // });


});

