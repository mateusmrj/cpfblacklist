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
    return view('index');
});

Route::get('/consulta', 'BlacklistController@consulta')->name('add');
Route::get('/adicionar', 'BlacklistController@adicionar')->name('adiciona');
Route::get('/remover', 'BlacklistController@remover')->name('remove');
