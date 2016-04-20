<?php

Route::get('/', 'IndexController@showIndex')->name('index');
Route::post('/', 'IndexController@showIndex');
Route::get('/', 'AuthController@getLogin')->name('login');
Route::post('/', 'AuthController@postLogin');
Route::get('/registration', 'AuthController@getRegister')->name('register');
Route::post('/registration', 'AuthController@postRegister');
Route::get('/confirm/{id}/{token}', 'AuthController@getConfirm')->name('confirm');
Route::post('/logout', 'AuthController@postLogout');



Route::get('/user/{id}', 'UserController@show')->name('profil');
Route::post('/user/edit/{id}', 'UserController@update');
Route::get('/user/edit/{id}', 'UserController@edit')->name('account');
Route::get('/user/destroy/{id}', 'UserController@destroy');


Route::get('/users', 'UserController@index'); //search




Route::group(array('namespace'=>'Admin'), function() {
    Route::get('/admin', array('as' => 'admin', 'uses' => 'DashController@index'));
    Route::get('/admin/users', array('as' => 'users', 'uses' => 'UserController@getAll'));
    Route::post('/admin/users', array('as' => 'users', 'uses' => 'UserController@postAll'));

});