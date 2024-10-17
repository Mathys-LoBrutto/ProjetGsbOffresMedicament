<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/formLogin', 'App\Http\Controllers\VisiteurController@getLogin');

Route::post('/login', 'App\Http\Controllers\VisiteurController@signIn');

Route::get('/getLogin', 'App\Http\Controllers\VisiteurController@signOut');

Route::get('/getListeFrais', 'App\Http\Controllers\FraisController@getFraisVisiteur');

Route::get('/modifierFrais/{id}', 'App\Http\Controllers\FraisController@updateFrais');

Route::post('/validerFrais', 'App\Http\Controllers\FraisController@validerFrais');

Route::get('/ajouterFrais', 'App\Http\Controllers\FraisController@addFrais');

Route::post('/validerFrais', 'App\Http\Controllers\FraisController@validerFrais');

Route::get('/supprimerFrais/{id}', 'App\Http\Controllers\FraisController@removeFrais');

Route::get('/getListeFraisHF/{id}' , 'App\Http\Controllers\FraisHFController@getFraisHF');

Route::get('/modifierFraisHF/{id}', 'App\Http\Controllers\FraisHFController@updateFraisHF');

Route::post('/validerFraisHF/{id}', 'App\Http\Controllers\FraisHFController@validerFraisHF');
