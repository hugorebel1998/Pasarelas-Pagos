<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/{catalogo}/opciones'], function () {

    Route::get('/', 'OpcionController@listar')->name('listar');
    Route::get('/{opcion}', 'OpcionController@listar')->name('mostrar');
    Route::post('/', 'OpcionController@crear')->name('crear');
    // Route::get('/', 'OpcionController@listar')->name('listar');

});
