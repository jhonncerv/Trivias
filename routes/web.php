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

Route::post('participante', 'SocialiteController@login');
Route::get('login/social', 'SocialiteController@redirectToProvider');
Route::get('login/social/callback', 'SocialiteController@handleProviderCallback');

//Auth::routes();
// rutas para la api
Route::get('/home', 'HomeController@index');

Route::get('trivias', 'TriviaController@index');
Route::get('preguntas', 'PreguntaController@index');
Route::get('respuestas', 'RespuestaController@index');
Route::get('participantes', 'ParticipanteController@index');
