<?php


Route::group([
    'namespace' => 'Softce\Type\Http\Controllers',
    'prefix' => 'admin/',
    'middleware' => ['web']
    ],function(){

    Route::resource( '/type', 'TypeController', [ 'as' => 'admin' ] );
    Route::post('/type/product', ['as' => 'type.product', 'uses' => 'TypeController@setToProduct']);

});