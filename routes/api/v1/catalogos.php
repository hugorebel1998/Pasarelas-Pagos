<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'catalogos', 'namespace' => 'Catalogos'], function () {

    Route::get('/', 'CatalogoController@listar')->name('listar');
    Route::get('/{catalogo}', 'CatalogoController@listar')->name('mostrar');
    Route::post('/', 'CatalogoController@crear')->name('crear');
    Route::put('/{catalogo}', 'CatalogoController@actualizar')->name('actualizar');
    
    
    require('catalogo/opciones.php');
});

