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

Route::get('/employes','EmployeController@index');
Route::post('/employes','EmployeController@store');
Route::post('/employes/import','EmployeController@import');
//BAT
Route::get('/BilanAccidentT','BatController@index');
Route::get('/BilanAccidentT/details','BatController@details');
Route::get('/BilanAccidentT/BilanMois','BatController@showBilanMois');
Route::get('/BilanAccidentT/BilanTrimestre','BatController@showBilanTrimestre');
Route::get('/BilanAccidentT/BilanSemestre','BatController@showBilanSemestre');
Route::get('/BilanAccidentT','BatController@index');
Route::get('/BilanAccidentT/create','BatController@create');
