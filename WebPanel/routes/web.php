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

Route::group(['middleware' => 'auth'],function(){
    Route::resource('/platforms','PlatformController');
    Route::resource('/services','ServiceController');
    Route::get('/servers/service/{sid}','ServerController@ServiceServers');
    Route::get('/servers/service/{sid}/add','ServerController@AddServerForService');
    Route::resource('/servers','ServerController');
    Route::resource('/settings','SettingsController');
    Route::resource('/properties','PropertyController');
    Route::resource('/tags','TagsController');
    Route::get('/','MainController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/devices' , 'DeviceController@index');
    Route::post('/devices' , 'DeviceController@search');
    Route::delete('/devices/{id}' , 'DeviceController@delete');
});


Auth::routes(['register' => true]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
