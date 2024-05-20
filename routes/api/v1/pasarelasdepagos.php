<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pasarelasdepagos', 'namespace' => 'PasarelaDePagos', 'middleware' => 'mainAuth'], function () {


    Route::get('/', 'PasarelaDePagosController@listar')->name('listar');
    Route::get('/{pasarela}', 'PasarelaDePagosController@listar')->name('mostrar');
    Route::post('/', 'PasarelaDePagosController@crear')->name('crear');
    Route::put('/{pasarela}', 'PasarelaDePagosController@actualizar')->name('actualizar');


});
