<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'solicitudes', 'namespace' => 'Solicitudes', 'middleware' => 'mainAuth'], function () {

    Route::get('/', 'SolicitudController@listar')->name('listar');
    Route::get('/{solicitud}', 'SolicitudController@listar')->name('mostrar');
    Route::post('/', 'SolicitudController@crear')->name('crear');

});
