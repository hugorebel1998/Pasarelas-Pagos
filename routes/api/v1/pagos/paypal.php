<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/paypal'], function () {
    Route::post('/{solicitud}', 'PaypalController@crear')->name('crear');

    Route::post('/webhook', 'PaypalController@webhook')->name('crear');

});
