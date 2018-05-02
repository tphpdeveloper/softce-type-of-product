<?php


Route::group([
    'namespace' => 'Softce\Type\Http\Controllers',
    'prefix' => 'admin/',
    'middleware' => ['web']
    ],function(){

    Route::resource( '/type', 'TypeController', [ 'as' => 'admin', 'only' => ['index', 'store', 'update', 'destroy'] ] );

});