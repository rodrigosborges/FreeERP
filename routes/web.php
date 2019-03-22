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
    return 'funcionando';
});

Route::get('/template', function () {
    return view('example', [
        'moduleIcon' => 'android',
        'moduleName' => 'Template',
        'menu' => [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
        ],
    ]);
});
