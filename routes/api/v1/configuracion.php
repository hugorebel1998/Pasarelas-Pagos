<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'configuracion', 'namespace' => 'Configuracion', 'middleware' => 'mainAuth'], function () {

    Route::get('/', 'ConfiguracionController@listar')->name('listar');
    Route::get('/{configuracion}', 'ConfiguracionController@listar')->name('mostrar');
    Route::post('/', 'ConfiguracionController@crear')->name('crear');
    Route::put('/{configuracion}', 'ConfiguracionController@actualizar')->name('actualizar');
    
});
