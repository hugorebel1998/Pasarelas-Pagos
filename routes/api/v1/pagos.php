<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/pagos', 'namespace' => 'Pagos'], function () {

    // Route::get('/', 'PagosController@listar')->name('listar');
    // Route::get('/{pago}', 'PagosController@listar')->name('mostrar');
    // Route::post('/{solicitud}', 'PagosController@crear')->name('crear');


    require('pagos/paypal.php');
});
