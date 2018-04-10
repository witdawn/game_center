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
Route::get('/index', 'IndexController@index');
Route::get('/socket', 'IndexController@socket');

Route::get('game/auth', 'GameController@GameAuth')->name('game_auth');
Route::group(['middleware' => 'game.auth', 'prefix' => '/game'], function () {

    Route::get('index', 'GameController@index');

});
