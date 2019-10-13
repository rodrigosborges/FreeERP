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

//Exemplo de como configurar a view
Route::get('/', function () {
    /* 
    | Defina os parâmetros do módulo que serão exibidos na View:
    | icon (icone "Material Icons")
    | name (nome do módulo)
    */
    $moduleInfo = [
        'icon' => 'android',
        'name' => 'Vendas',
    ];
    /* 
    | Defina os itens (funcionalidades) do menu principal do módulo
    | icon (icone "Material Icons")
    | tool (nome da funcionalidade)
    | route (rota de ação da funcionalidade)
    */
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
        ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
        ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
        ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
    ];
    // Passe os parâmetros definidos utilizando as chaves 'moduleInfo' e 'menu'
    return view('example', [
        'moduleInfo' => $moduleInfo,
        'menu' => $menu,
    ]);
});
