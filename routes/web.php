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

Route::group(['middleware' => 'vigencia'], function () {
    Route::get('/', 'CiudadController@index')->name('home');
    Route::get('/tyco', 'CiudadController@tyco')->name('tyco');
    Route::get('/mecanica', 'CiudadController@mecanica')->name('mecanica');
    Route::post('/postales/share', 'PostalController@postea');

    Route::get('/logout', 'SocialiteController@logout');
    Route::post('login/participante', 'SocialiteController@login');
    Route::get('login/social', 'SocialiteController@redirectToProvider');
    Route::get('login/social/callback', 'SocialiteController@handleProviderCallback');
});
Route::get('/postales', 'PostalController@index')->name('postales');
Route::get('/postales/{id}', 'PostalController@postal')->name('postal');
//Route::get('/respromo/resultados', 'PostalController@resultados')->name('resultados');

//Auth::routes();
Route::get('/despedida', 'CiudadController@despedida')->name('despedida');

// rutas para la api
//Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth', 'vigencia']], function () {
    Route::post('start', 'TriviaController@startGame');
    Route::post('save', 'TriviaController@stopGame');
    Route::post('dynamic', 'TriviaController@todayGame');
    //Route::post('mi-puntaje', 'ParticipanteController@mipuntaje');
    //Route::post('puntajes', 'ParticipanteController@puntajes');
    Route::post('/postales/toshare/', 'PostalController@sinCompartir');
});
