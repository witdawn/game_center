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

Route::get('error/', 'CommonController@error_page')->name('error_page');

Route::get('/index', 'IndexController@index');
Route::get('/socket', 'IndexController@socket');

//需要活动认证
Route::group(['middleware' => 'game.active'], function () {

    //手机端
    Route::group(['prefix' => '/game'], function () {
        //微信授权
        Route::get('/auth', 'GameController@GameAuth')->name('game_auth');

        //需要授权认证
        Route::group(['middleware' => 'game.wx'], function () {
            //测试
            Route::get('index', 'GameController@index');
        });
    });

    //大屏幕
    Route::group(['prefix' => '/screen'],function (){
        Route::get('/question','ScreenController@questions');
    });

});

