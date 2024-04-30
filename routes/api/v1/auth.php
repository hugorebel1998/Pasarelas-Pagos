<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::post('/login', 'AuthController@inicioSesion')->name('inicio-sesion');
    Route::post('/registar', 'AuthController@registar')->name('registrar');

});
