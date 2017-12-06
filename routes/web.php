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
    return view('qr.form');
});

Route::post('/countries',  'CommonController@getCountries')->name('common.countries');
Route::post('/states',  'CommonController@getStates')->name('common.states');
Route::post('/cities',  'CommonController@getCities')->name('common.cities');

Route::post('/render/qr',  'QrController@doRender')->name('qr.render');
Route::any('/qrs/{id}',  'QrController@detail')->name('qr.detail');
