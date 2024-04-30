<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'usuarios', 'namespace' => 'Usuarios', 'middleware' => 'mainAuth'], function () {

    Route::get('/', 'UsuarioController@listar')->name('listar');
    Route::get('/{usuario}', 'UsuarioController@listar')->name('mostrar');
    Route::post('/', 'UsuarioController@crear')->name('crear');
    Route::put('/{usuario}', 'UsuarioController@actualizar')->name('actualizar');
    Route::delete('/{usuario}', 'UsuarioController@eliminar')->name('eliminar');
    Route::get('/restablecer/{usuario}', 'UsuarioController@restablecer')->name('restablecer');
    Route::put('/contrasena/{usuario}', 'UsuarioController@restablecerContrasena')->name('contrasena');
});
