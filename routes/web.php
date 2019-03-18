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

Route::get('/', function () {
    $data = [
        'title' => 'Menu'
    ];
    return view('welcome', compact('data'));
});

Route::resource('aluno', 'AlunoController');
Route::resource('aula', 'AulaController');
Route::resource('professor', 'ProfessorController');

//exemplo de utilização de middleware numa rota unica
Route::get('testeMiddleware', function(){
    return 'oi';
})->middleware(['OnlyBefore19H']);

//exemplo de utilização de middleware em grupo de rotas
Route::middleware(['OnlyBefore19H'])->group(function () {
    Route::get('testeMiddleware2', function(){
        return 'oi';
    });
});
