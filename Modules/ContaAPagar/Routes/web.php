<?php

use \Modules\ContaAPagar\Http\Controllers\ContaAPagarController;

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

Route::prefix('contaapagar')->group(function() {
    Route::get('/', 'ContaAPagarController@index');
    Route::get('/', ['as' => 'contaapagar', 'uses' => 'ContaAPagarController@index']);
    Route::get('cat={id}', ['as' => 'cat.id', 'uses' => 'ContaAPagarController@filtro']);
    
    Route::get('check/teste', ['as' => 'check.status', 'uses' => 'ContaAPagarController@status']);
    
});

Route::prefix('novaconta')->group(function() {
   Route::get('/', 'NovaContaController@index'); 
});

Route::prefix('categoria')->group(function ($id) {
    Route::get('/', 'CategoriaController@index');
});

