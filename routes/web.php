<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


    Route::group(['middleware' => ['auth']], function () {
        Route::get('/container-list', 'ContainerlistController@index');
        Route::post('/getListContainer', 'ContainerlistController@getListContainer');
        Route::get('/weighTickets-list', 'ContainerlistController@weighTicketsview');
        Route::get('/getPdf/{id}', 'ContainerlistController@getPDF');
        Route::post('/getListWeighTickets', 'ContainerlistController@getListWeighTickets');

        Route::get('/corporate-information', 'Frontend\CorporateInformationController@index');
        Route::post('/insertCorporateInformation', 'Frontend\CorporateInformationController@insertcorporateinformation');


    });
