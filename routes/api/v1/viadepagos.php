<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'viadepagos', 'namespace' => 'ViaDePagos', 'middleware' => 'mainAuth'], function () {


    Route::get('/', 'ViaDePagosController@listar')->name('listar');
    Route::get('/{viadepago}', 'ViaDePagosController@listar')->name('mostrar');
    Route::post('/', 'ViaDePagosController@crear')->name('crear');
    Route::put('/{viadepago}', 'ViaDePagosController@actualizar')->name('actualizar');
});
