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

// 验证码
Route::get('captcha', function () {
    $qrcode = new \App\Extension\QrCode();
    $qrcode->generate();
    return response('', 200, ['Content-Type' => 'image/gif']);
})->name('captcha');

Route::get('error/', 'CommonController@error_page')->name('error_page');

Route::get('/tt', 'IndexController@test');
//登录
Route::get('/login', 'IndexController@login');

//需要登录权限
Route::group(['middleware' => 'login_auth'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/index', 'IndexController@index');
    Route::get('/activities', 'IndexController@activities');
    Route::get('/questions', 'IndexController@question_manager');
    Route::get('/winnners', 'IndexController@question_winners')->name('winner_list');
});

//需要活动认证
Route::group(['middleware' => 'game.active'], function () {

    //手机端
    Route::group(['prefix' => '/game'], function () {
        //微信授权
        Route::get('/auth', 'GameController@GameAuth')->name('game_auth');

        //需要授权认证
        Route::group(['middleware' => 'game.wx'], function () {
            //测试
            Route::get('index', 'GameController@index')->name('mobile_index');
            Route::get('question', 'GameController@question')->name('mobile_question');
            Route::get('question_win', 'GameController@question_win')->name('mobile_question_win');
        });
    });

    //大屏幕
    Route::group(['prefix' => '/screen'], function () {
        Route::get('/q_index', 'ScreenController@questionIndex')->name('q_index');
        Route::get('/question', 'ScreenController@questions')->name('screen_question');
        Route::get('/winner_rank', 'ScreenController@winnerRank')->name('winners');
    });

});

