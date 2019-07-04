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

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function() {
    
});

    Route::get('candidates', 'CandidateController@index');
    Route::get('candidates/{candidate}', 'CandidateController@show');
    Route::post('candidates', 'CandidateController@store');
    Route::post('candidates/{candidate}', 'CandidateController@update');
    Route::delete('candidates/{candidate}', 'CandidateController@delete');

    Route::get('positions', 'PositionController@index');
    Route::post('positions', 'PositionController@store');
    Route::post('positions/{position}', 'PositionController@update');


