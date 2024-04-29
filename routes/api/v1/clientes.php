<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clientes', 'namespace' => 'Clientes'], function () {

    Route::get('/', 'ClienteController@listar')->name('listar');
    Route::get('/{cliente}', 'ClienteController@listar')->name('mostrar');
    Route::post('/', 'ClienteController@crear')->name('crear');
    Route::put('/{cliente}', 'ClienteController@actualizar')->name('actualizar');
    Route::put('/contrasena/{cliente}', 'ClienteController@restablecerContrasena')->name('contrasena');
});
