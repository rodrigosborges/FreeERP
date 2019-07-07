<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('funcionario/frequencia/biometricUsers','FrequenciaController@biometricUsers');
Route::get('funcionario/frequencia/list','FrequenciaController@list');
Route::post('funcionario/frequencia/biometry/{id}','FrequenciaController@biometry');
Route::post('funcionario/frequencia/ponto/{id}','FrequenciaController@ponto');

Route::middleware('auth:api')->get('/funcionario', function (Request $request) {
    return $request->user();
});