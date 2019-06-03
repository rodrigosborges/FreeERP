<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::prefix('controleusuario')->group(function() {
    //rotas de autenticação de usuario
    Route::get('/autenticar', 'UsuarioController@viewAutenticar');
    Route::post('/autenticar',['as'=>'validar.login', 'uses'=>'UsuarioController@validaLogin']);
    Route::get('/',['as'=>'index', 'uses'=>'UsuarioController@index']);
    // rota é composta por: /caminho, ClasseController@nomeMétodo
    Route::get('/logoff',['as'=>'user.logoff','uses'=>'UsuarioController@logoff']);
    Route::get('/cadastrar', 'UsuarioController@viewCadastro');
    Route::post('/cadastrar',['as'=>'validar.cadastro', 'uses'=>'UsuarioController@cadastrar']);
    Route::put('/cadastrar',['as'=>'validar.edicao', 'uses'=> 'UsuarioController@update']);

    Route::get('/consulta', 'UsuarioController@consulta');

    Route::post('/salvar',['as'=>'usuario.salvar','uses'=> 'UsuarioController@salvarCadastro']);


    Route::get('/inativar/{id}', 'UsuarioController@inativar');
    Route::post('/editar', ['as'=>'usuario.abrir','uses'=> 'UsuarioController@editar'] );

    Route::post('/listar',['as'=>'usuario.listar','uses'=> 'UsuarioController@buscar']);



    Route::post('/teste_bt', ['as'=>'teste_bt', 'uses'=>'UsuarioController@bt_buscar']);
    Route::delete('/delete', ['as'=>'usuario.delete','uses'=> 'UsuarioController@destroy'] );


/*ROTAS DE PAPÉIS (PAPEL)*/

    Route::resource('/papel', 'PapelController');

});
