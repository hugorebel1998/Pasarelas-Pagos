<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'catalogos', 'namespace' => 'Catalogos', 'middleware' => 'mainAuth'], function () {

    Route::get('/', 'CatalogoController@listar')->name('listar');
    Route::get('/{catalogo}', 'CatalogoController@listar')->name('mostrar');
    Route::get('/codigo/{codigo}', 'CatalogoController@byCodigo')->name('codigo');
    Route::post('/', 'CatalogoController@crear')->name('crear');
    Route::put('/{catalogo}', 'CatalogoController@actualizar')->name('actualizar');


    require('catalogo/opciones.php');
});
