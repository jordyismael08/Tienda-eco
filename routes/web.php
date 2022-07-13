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

use Illuminate\Support\Facades\Route;

Route::get('/','ContentController@getHome');

/*Lo comente para crear un nuevo controlador
Route::get('/', function () {
    return view('welcome');
});
*/
//Router Auth
Route::get('/login','ConnectController@getLogin')->name('login');
Route::post('/login','ConnectController@postLogin')->name('login');
Route::get('/recuperar','ConnectController@getRecover')->name('recuperar');
Route::post('/recuperar','ConnectController@postRecover')->name('recuperar');
Route::get('/reset','ConnectController@getReset')->name('reset');
Route::post('/reset','ConnectController@postReset')->name('reset');
Route::get('/registro','ConnectController@getRegistro')->name('registro');
Route::post('/registro','ConnectController@postRegistro')->name('registro');
Route::get('/logout','ConnectController@getLogout')->name('logout');
