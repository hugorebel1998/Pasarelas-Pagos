<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/{solicitud}/pagos'], function () {

    Route::get('/', 'PagosController@listar')->name('listar');
    Route::get('/{pago}', 'PagosController@listar')->name('mostrar');
    Route::post('/', 'PagosController@crear')->name('crear');

});
