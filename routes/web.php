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

//Users
Route::get('/users','UserController@index');
Route::post('/users','UserController@store');

//Unités
Route::get('/unites','UniteController@index');
Route::post('/unites','UniteController@store');
Route::delete('/unites/{id}','UniteController@destroy');

//Employe
Route::get('/employes','EmployeController@index');
Route::post('/employes','EmployeController@store');
Route::put('/employes/{id}','EmployeController@update');
Route::get('/employes/profil/{id}','EmployeController@show');
Route::post('/employes/import','EmployeController@import');
Route::get('/employes/export','EmployeController@export');
Route::delete('/employes/{id}','EmployeController@destroy');

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
Route::get('/BilanAccidentM/detail/{year}','BamController@detail');
Route::get('/BilanAccidentM/mois/{mois}/{year}','BamController@parMois');
Route::get('/BilanAccidentM/trimestre/{t}/{year}','BamController@parTrimestre');
Route::get('/BilanAccidentM/semestre/{s}/{year}','BamController@parSemestre');

//DAT
Route::get('/DeclarationAccidentT','DatController@index');
Route::get('/DeclarationAccidentT/create','DatController@create');
Route::get('/DeclarationAccidentT/{id}/edit','DatController@edit');
Route::put('/DeclarationAccidentT/{id}','DatController@update');
Route::post('/DeclarationAccidentT','DatController@store');
Route::get('/DeclarationAccidentT/show/{id}','DatController@show');
Route::delete('/DeclarationAccidentT/{id}','DatController@destroy');

//DAM
Route::get('/DeclarationAccidentM','DamController@index');
Route::get('/DeclarationAccidentM/create','DamController@create');
Route::get('/DeclarationAccidentM/{id}/edit','DamController@edit');
Route::put('/DeclarationAccidentM/{id}','DamController@update');
Route::post('/DeclarationAccidentM','DamController@store');
Route::get('/DeclarationAccidentM/show/{id}','DamController@show');
Route::delete('/DeclarationAccidentM/{id}','DamController@destroy');

//MT
Route::get('/MedcineDeTravail','MtController@index');
Route::post('/MedcineDeTravail','MtController@store');
Route::put('/MedcineDeTravail/{id}','MtController@update');
Route::get('/MedcineDeTravail/show/{id}','MtController@show');
Route::get('/MedcineDeTravail/detail/{year}','MtController@detail');
Route::get('/MedcineDeTravail/mois/{mois}/{year}','MtController@parMois');
Route::get('/MedcineDeTravail/trimestre/{t}/{year}','MtController@parTrimestre');
Route::get('/MedcineDeTravail/semestre/{s}/{year}','MtController@parSemestre');
Route::delete('/MedcineDeTravail/{id}','MtController@destroy');
Route::get('/MedcineDeTravail/exportAnnuel/{year}','MtController@exportAnnuel');
Route::get('/MedcineDeTravail/exportMensuel/{mois}/{year}','MtController@exportMensuel');
Route::get('/MedcineDeTravail/exportTrimestriel/{t}/{year}','MtController@exportTrimestriel');
Route::get('/MedcineDeTravail/exportSemestriel/{t}/{year}','MtController@exportSemestriel');

//Amenagement de poste
Route::get('/AmenagementPost','AmenagementController@index');
Route::post('/AmenagementPost','AmenagementController@store');
Route::delete('/AmenagementPost/{id}','AmenagementController@destroy');

//CHS
Route::get('/CommissionHygieneSecurite','ChsController@index');
Route::post('/CommissionHygieneSecurite','ChsController@store');
Route::put('/CommissionHygieneSecurite/{id}','ChsController@update');
Route::get('/CommissionHygieneSecurite/show/{year}','ChsController@show');
Route::delete('/CommissionHygieneSecurite/{id}','ChsController@destroy');

//PHS
Route::get('/PlanHygieneSecurite','PhsController@index');
Route::post('/PlanHygieneSecurite','PhsController@store');
Route::delete('/PlanHygieneSecurite/{id}','PhsController@destroy');

//IHSE
Route::get('/InductionHSE','IhseController@index');
Route::post('/InductionHSE','IhseController@store');
Route::get('/InductionHSE/show/{year}','IhseController@show');
Route::delete('/InductionHSE/{id}','IhseController@destroy');

//MLCI
Route::get('/MLCI','MlciController@index');
Route::post('/MLCI','MlciController@store');

//Biblio
Route::get('/Bibliotheque','BiblioController@index');
Route::get('/Bibliotheque/details/{id}','BiblioController@detail');
Route::post('/Bibliotheque','BiblioController@store');
Route::post('/Bibliotheque/emplacement','BiblioController@storeEmplacement');
Route::delete('/Bibliotheque/{id}','BiblioController@destroy');

//Cartes
Route::get('/Cartes','CarteController@index');
Route::get('/Cartes/details/{id}','CarteController@detail');
Route::post('/Cartes','CarteController@store');
Route::post('/Cartes/emplacement','CarteController@storeEmplacement');
Route::delete('/Cartes/{id}','CarteController@destroy');

//S.M.HSE
Route::get('/S_M_HSE','SmhseController@index');
Route::get('/S_M_HSE/archives','SmhseController@indexArchives');
Route::post('/S_M_HSE','SmhseController@store');
Route::post('/S_M_HSE/archiver/{id}','SmhseController@archiver');
Route::delete('/S_M_HSE/{id}','SmhseController@destroy');
