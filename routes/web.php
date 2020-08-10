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
Route::get('/BilanAccidentT/details/{annee}','BatController@details');
Route::get('/BilanAccidentT/BilanMoisA/{mois}/{annee}','BatController@showBilanMoisA');
Route::get('/BilanAccidentT/BilanMois/{id}','BatController@showBilanMois');
Route::get('/BilanAccidentT/BilanTrimestre/{id}','BatController@showBilanTrimestre');
Route::get('/BilanAccidentT/BilanTrimestreA/{t}/{annee}','BatController@showBilanTrimestreA');
Route::get('/BilanAccidentT/BilanSemestre/{id}','BatController@showBilanSemestre');
Route::get('/BilanAccidentT/BilanSemestreA/{s}/{annee}','BatController@showBilanSemestreA');
Route::get('/BilanAccidentT','BatController@index');
Route::get('/BilanAccidentT/create','BatController@create');
Route::post('/BilanAccidentT','BatController@store');

//Export 
Route::get('/exportBilanAnnuel/{id}','PdfController@exportBilanAnnuel');
Route::get('/exportConsolideAnnuel/{annee}','PdfController@exportConsolideAnnuel');
Route::get('/exportBilanMensuel/{id}','PdfController@exportBilanMensuel');
Route::get('/exportConsolideMensuel/{mois}/{annee}','PdfController@exportConsolideMensuel');
Route::get('/exportBilanTrimestriel/{id}','PdfController@exportBilanTrimestriel');
Route::get('/exportConsolideTrimestriel/{t}/{annee}','PdfController@exportConsolideTrimestriel');
Route::get('/exportBilanSemestriel/{id}','PdfController@exportBilanSemestriel');
Route::get('/exportConsolideSemestriel/{s}/{annee}','PdfController@exportConsolideSemestriel');
Route::get('/exportDeclarationMateriel/{id}','PdfController@exportDeclarationM');
Route::get('/exportDeclarationTravail/{id}','PdfController@exportDeclarationT');

//BAM
Route::get('/BilanAccidentM','BamController@index');

//DAT
Route::get('/DeclarationAccidentT','DatController@index');
Route::get('/DeclarationAccidentT/create','DatController@create');
Route::post('/DeclarationAccidentT','DatController@store');
Route::get('/DeclarationAccidentT/show/{id}','DatController@show');

//DAM
Route::get('/DeclarationAccidentM','DamController@index');
Route::get('/DeclarationAccidentM/create','DamController@create');
Route::post('/DeclarationAccidentM','DamController@store');
Route::get('/DeclarationAccidentM/show/{id}','DamController@show');

//MT
Route::get('/MedcineDeTravail','MtController@index');
Route::post('/MedcineDeTravail','MtController@store');
Route::get('/MedcineDeTravail/show/{id}','MtController@show');

//CHS
Route::get('/CommissionHygieneSecurite','ChsController@index');
Route::post('/CommissionHygieneSecurite','ChsController@store');

//PHS
Route::get('/PlanHygieneSecurite','PhsController@index');
Route::post('/PlanHygieneSecurite','PhsController@store');

//IHSE
Route::get('/InductionHSE','IhseController@index');
Route::post('/InductionHSE','IhseController@store');

//MLCI
Route::get('/MLCI','MlciController@index');
Route::post('/MLCI','MlciController@store');

//Biblio
Route::get('/Bibliotheque','BiblioController@index');

//Cartes
Route::get('/Cartes','CarteController@index');

//S.M.HSE
Route::get('/S_M_HSE','SmhseController@index');
Route::get('/S_M_HSE/archives','SmhseController@indexArchives');
Route::post('/S_M_HSE','SmhseController@store');
Route::post('/S_M_HSE/archiver/{id}','SmhseController@archiver');
Route::delete('/S_M_HSE/{id}','SmhseController@destroy');
