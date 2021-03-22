<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1','middleware' => ['auth:api']], function () {
    Route::post('logout', 'AuthenticatesController@logout');
    
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::post('login', 'AuthenticatesController@login');
    Route::get('container-type', 'ContainerController@getContainerType');
});  