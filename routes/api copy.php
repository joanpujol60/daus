<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    
    
    // Las siguientes rutas además del prefijo requieren que el usuario tenga un token válido
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        // Aquí agrega tus rutas de la API. En mi caso (EN MI CASO, EL TUYO PUEDE VARIAR) he agregado una de productos
        Route::post("players", function () {
            return response()->json(\App\Players::all());
        });
    });
});