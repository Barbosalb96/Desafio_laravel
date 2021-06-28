<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/admin', 'HomeController@Admin')->name('admin')->middleware('auth');
Route::get('/dicas', 'HomeController@adminDicas')->name('dicas')->middleware('auth');
Route::any('/search/{id?}', 'HomeController@FiltroDica')->name('filterDicas');
Route::any('/searchDicasUser', 'HomeController@filtroDicasUser')->name('filterMyDicas')->middleware('auth');
Route::post('/store', 'VeiculoController@store')->name('store')->middleware('auth');
Route::get('/edit/{id}', 'VeiculoController@edit')->name('edit')->middleware('auth');
Route::put('/update/{id}', 'VeiculoController@update')->name('update')->middleware('auth');
Route::delete('/delete/{id}', 'VeiculoController@delete')->name('delete')->middleware('auth');
