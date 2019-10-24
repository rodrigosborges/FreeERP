<?php

use Illuminate\Http\Request;
use App\Entities\Estado;
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

Route::middleware('auth:api')->get('/assistencia', function (Request $request) {
    return $request->user();
});
Route::get('assistencia/cidades/{id}', function($id){
        
    $estado = Estado::findorFail($id);
    
    $cidades = $estado->cidades()->getQuery()->get(['id', 'nome']);
    
    return Response::json($cidades);
});