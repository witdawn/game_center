<?php

Route::post('login','Api\IndexController@login')->name('login');
//需要活动认证
Route::group(['middleware' => 'game.active'], function () {
    Route::group(['prefix' => '/screen'], function () {
        Route::post('/change_round', 'Api\QuestionController@change_round')->name('change_round');
    });
});
