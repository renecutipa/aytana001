<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:api')->resource('diag','Cie10Controller');
Route::get('diag/{v}','Cie10Controller@getByText');
Route::get('dx/{id}','Cie10Controller@getById');

Route::get('saveDx/{id_fua}','FUAController@saveDx');
Route::get('saveAPO/{id_fua}','FUAController@saveAPO');
Route::get('saveVAC/{id_fua}','FUAController@saveVAC');

Route::get('cp/{id_afiliado}/{id_cp}','FUAController@checkCP');




