<?php

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
