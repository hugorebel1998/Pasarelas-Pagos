<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pasarelasdepagos', 'namespace' => 'PasarelaDePagos', 'middleware' => 'mainAuth'], function () {


    Route::get('/', 'PasarelaDePagosController@listar')->name('listar');
    Route::get('/{viadepago}', 'PasarelaDePagosController@listar')->name('mostrar');
    Route::post('/', 'PasarelaDePagosController@crear')->name('crear');
    Route::put('/{viadepago}', 'PasarelaDePagosController@actualizar')->name('actualizar');
});
