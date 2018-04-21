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
    return error_page('coding');
});
Route::get('/tt', 'IndexController@test');

Route::get('error/', 'CommonController@error_page')->name('error_page');

Route::get('/index', 'IndexController@index');
Route::get('/socket', 'IndexController@socket');

//微信授权
Route::get('/game/auth', 'GameController@GameAuth')->name('game_auth');

//需要活动认证
Route::group(['middleware' => 'game.active'], function () {

    //手机端
    Route::group(['prefix' => '/game'], function () {


        //需要授权认证
        Route::group(['middleware' => 'game.wx'], function () {
            //测试
            Route::get('index', 'GameController@index');
            Route::get('question', 'GameController@question')->name('mobile_question');
            Route::get('question_win', 'GameController@question_win')->name('mobile_question_win');
        });
    });

    //大屏幕
    Route::group(['prefix' => '/screen'], function () {
        Route::get('/q_index', 'ScreenController@questionIndex')->name('q_index');
        Route::get('/question', 'ScreenController@questions')->name('screen_question');
        Route::get('/winner_rank', 'ScreenController@winnerRank')->name('winners');
        Route::post('/question_change_round', 'Api\QuestionController@change_round')->name('change_round');
    });

});

