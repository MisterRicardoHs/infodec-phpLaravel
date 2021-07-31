<?php

    Route::group(['middleware' => 'web'], function(){

        Route::group(array('namespace' => 'App\Modulos\Inicio\Controllers') , function(){
            Route::resource('', 'InicioController');
            Route::resource('inicio', 'InicioController');
            Route::post('eliminarregistro', 'InicioController@destroy');
        });

    });


?>