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

Route::get('generator', 'ImageGenerateController@index');

Route::post('generator/create', 'ImageGenerateController@createImage');

Route::get('watermark', 'WaterMarkController@index');

Route::post('watermark/create', 'WaterMarkController@createImage');

Route::get('reiwa', 'ReiwaFakeAdController@index');

Route::get('reiwa/create', 'ReiwaFakeAdController@createImage');
