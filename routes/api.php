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

Route::post('ciudad/{id}', 'TriviaController@todayGame');
Route::post('ciudad/{id}/start', 'TriviaController@startGame');
Route::post('ciudad/{id}/stop', 'TriviaController@stopGame');
Route::post('mi-puntaje', 'ParticipanteController@mipuntaje');
Route::post('puntajes', 'ParticipanteController@puntajes');
Route::post('postal', 'PostalController@postal');