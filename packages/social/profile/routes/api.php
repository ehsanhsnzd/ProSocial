<?php
/**
 * Created by PhpStorm.
 * User: Ehsan
 * Date: 8/11/18
 * Time: 4:01 PM
 */



Route::group(['namespace' => 'social\profile\app\Http\Controllers\API'], function () {
    Route::prefix('/api/')->middleware(['Cors','Json'])->group(function () {

        Route::post('login', 'UserController@login');
        Route::post('register', 'UserController@register');
        Route::post('resetPasswordEmail', 'UserController@ResetPasswordEmail');
        Route::post('verifyEmail','UserController@VerifyEmail');
        Route::post('resetPassword','UserController@ResetPassword');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('user', 'UserController@details');
            Route::get('profile', 'UserController@profile');
            Route::put('profile/{iId}', 'UserController@UpdateProfile');
            Route::put('user/{iId}', 'UserController@UpdateUser');

            Route::get('jobs', 'JobController@getAll');
            Route::get('job/{iId}', 'JobController@get');
            Route::post('job', 'JobController@set');
            Route::put('job/{iId}', 'JobController@update');
            Route::delete('job/{iId}', 'JobController@delete');

            Route::get('posts', 'PostController@getAll');
            Route::get('post/{iId}', 'PostController@get');
            Route::post('post', 'PostController@set');
            Route::put('post/{iId}', 'PostController@update');
            Route::delete('post/{iId}', 'PostController@delete');

            Route::get('educations', 'EducationController@getAll');
            Route::get('education/{iId}', 'EducationController@get');
            Route::post('education', 'EducationController@set');
            Route::put('education/{iId}', 'EducationController@update');
            Route::delete('education/{iId}', 'EducationController@delete');

            Route::get('messages', 'MessageController@getAll');
            Route::get('messageSent/{iId}', 'MessageController@getSent');
            Route::get('messageReceive/{iId}', 'MessageController@getReceive');
            Route::get('chat/{iId}', 'MessageController@getChat');
            Route::post('message', 'MessageController@set');
            Route::put('message/{iId}', 'MessageController@update');
            Route::delete('message/{iId}', 'MessageController@delete');

            Route::get('connections', 'ConnectionController@getAll');
            Route::post('connection', 'ConnectionController@set');
            Route::delete('connection/{iId}', 'ConnectionController@delete');

            Route::get('notifications', 'NotificationController@getAll');
            Route::delete('notification/{iId}', 'NotificationController@delete');

            Route::get('follows', 'FollowController@getAll');
            Route::post('follow', 'FollowController@set');
            Route::delete('follow/{iId}', 'FollowController@delete');

//            Route::get('companyAdmins', 'CompanyAdminController@getAll');
//            Route::post('companyAdmin', 'CompanyAdminController@set');
//            Route::delete('companyAdmin/{iId}', 'CompanyAdminController@delete');

            Route::get('skills', 'SkillController@getAll');
            Route::post('skill', 'SkillController@set');
            Route::delete('skill/{iId}', 'SkillController@delete');

            Route::get('projects', 'ProjectController@getAll');
            Route::get('project/{iId}', 'ProjectController@get');
            Route::post('project', 'ProjectController@set');
            Route::post('setProject', 'ProjectController@setTo');
            Route::put('project/{iId}', 'ProjectController@update');
            Route::delete('project/{iId}', 'ProjectController@delete');


        });
    });


});

