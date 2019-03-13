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

Route::get('importExport', 'ExcelController@importExport');
Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');
Route::post('importExcel', 'ExcelController@importExcel');

Route::resource('fuas','FUAController');

Route::get('buscarFUA','HomeController@fuas')->name('buscarFUA');
Route::get('buscarAfiliado','HomeController@afiliados')->name('buscarAfiliado');

Route::get('fuas/create/{id_afiliado}', 'FUAController@create');
Route::get('fuas/{id}/edit', ['uses' => 'FUAController@update', 'as' => 'fua.edit']);

Route::get('fuas/close/{id_fua}', ['uses' => 'FUAController@close', 'as' => 'fua.close']);