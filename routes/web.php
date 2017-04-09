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
})->name('home');

Route::post('participante', 'SocialiteController@login');
Route::get('login/social', 'SocialiteController@redirectToProvider');
Route::get('login/social/callback', 'SocialiteController@handleProviderCallback');
Route::get('social', 'SocialiteController@login');

//Auth::routes();
// rutas para la api
Route::get('/home', 'HomeController@index');

Route::get('trivias', 'TriviaController@index');
Route::get('preguntas', 'PreguntaController@index');
Route::get('respuestas', 'RespuestaController@index');
Route::get('participantes', 'ParticipanteController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('trivia/start', 'TriviaController@startGame');
    Route::post('trivia/stop', 'TriviaController@stopGame');
    Route::get('ciudad/{id}', 'TriviaController@todayGame');
    Route::post('mi-puntaje', 'ParticipanteController@mipuntaje');
    Route::post('puntajes', 'ParticipanteController@puntajes');
    Route::post('postal', 'PostalController@postal');
});
