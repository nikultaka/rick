<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1','middleware' => ['auth:api']], function () {
    Route::post('logout', 'AuthenticatesController@logout');
    Route::post('store-wegen', 'ContainerController@storeWegen');
    Route::get('container-detail', 'ContainerController@containerDetail');
    Route::get('container-type', 'ContainerController@getContainerType');
    Route::get('client-list', 'ClientlistController@getClientList');
    Route::post('store-afzettern', 'ContainerController@storeContainer');
    Route::get('get-license', 'ContainerController@getLicence');
    Route::post('container-handling', 'ContainerController@containerHandling');
});
Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::post('login', 'AuthenticatesController@login');

});  
