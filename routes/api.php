<?php

Route::post('login', 'Api\IndexController@login')->name('login');
//需要活动认证
Route::group(['middleware' => 'game.active'], function () {
    Route::group(['prefix' => '/screen'], function () {
        Route::post('/change_round', 'Api\QuestionController@change_round')->name('change_round');
    });
});

Route::group(['middleware' => 'login_auth'], function () {
    Route::get('activies', 'Api\IndexController@getActivities')->name('get_activities');
    Route::post('/add_questions', 'Api\QuestionController@addQuestion')->name('add_questions');
    Route::get('/get_questions', 'Api\QuestionController@getQuestions')->name('get_questions');
    Route::get('/delete_questions', 'Api\QuestionController@deleteQuestions')->name('delete_questions');
    Route::get('/get_winners', 'Api\QuestionController@getWinners')->name('get_winners');
});


