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

////需要活动认证
//Route::group(['middleware' => 'game.active'], function () {
//    //大屏幕
//    Route::group(['prefix' => '/screen'], function () {
//        Route::post('/question_change_round', 'Api\QuestionController@change_round')->name('change_round');
//    });
//
//});
