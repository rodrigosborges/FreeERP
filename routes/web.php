<?php

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
