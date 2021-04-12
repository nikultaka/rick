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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// theme implementation
Route::get('/', 'containertheme\MainthemepageController@login');
Route::get('/login', 'containertheme\MainthemepageController@login')->name('login');
Route::get('/forgotpassword', 'containertheme\MainthemepageController@forgotpassword')->name('forgotpassword');
Route::get('/newpassword/{token}', 'containertheme\MainthemepageController@newpassword')->name('newpassword');
Route::get('/register', 'containertheme\MainthemepageController@register')->name('register');

// after login
Route::group(['middleware' => ['auth']], function () { 
        Route::get('/dashboard-theme','containertheme\DashboardthemeController@index')->name('dashboard-theme');
       
        Route::get('/corporate-information', 'Frontend\CorporateInformationController@index')->name('corporate-information');
        Route::post('/insertCorporateInformation', 'Frontend\CorporateInformationController@insertcorporateinformation');
        
        Route::get('/container-list', 'ContainerlistController@index')->name('container-list');
        Route::post('/getListContainer', 'ContainerlistController@getListContainer');

        Route::get('/weightickets-list', 'ContainerlistController@weighTicketsview')->name('weightickets-list');
        Route::get('/getPdf/{id}', 'ContainerlistController@getPDF');
        Route::post('/getListWeighTickets', 'ContainerlistController@getListWeighTickets');

        Route::get('/handlingstatus', 'Frontend\HandlingstatusController@index')->name('handlingstatus');
        Route::post('/gethandlingstatus', 'Frontend\HandlingstatusController@gethandlingstatus');
        Route::post('/deletehandalingdata', 'Frontend\HandlingstatusController@deletehandalingdata');
        Route::post('/edithandalingdata', 'Frontend\HandlingstatusController@edithandalingdata');
        Route::post('/updatehandalingdata', 'Frontend\HandlingstatusController@updatehandalingdata');



});

