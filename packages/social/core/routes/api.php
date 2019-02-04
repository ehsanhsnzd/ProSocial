<?php
/**
 * Created by PhpStorm.
 * User: Ehsan
 * Date: 8/11/18
 * Time: 4:01 PM
 */

Route::group(['namespace' => 'social\core\app\Http\Controllers'], function () {

    Route::prefix('/social/core/api/')->middleware(['Cors', 'Json'])->group(function () {

        Route::get('baseSettings', 'BaseSettingController@getAll');
        Route::get('baseSetting/{iId}', 'BaseSettingController@get');
        Route::get('baseSetting/settings/{value}', 'BaseSettingController@settings');
        Route::get('settings', 'SettingController@getAll');
        Route::get('setting/{iId}', 'SettingController@get');

        Route::group(['middleware' => ['auth:api', 'Admin']], function () {



            Route::post('baseSetting', 'BaseSettingController@set');
            Route::put('baseSetting/{iId}', 'BaseSettingController@update');
            Route::delete('baseSetting/{iId}', 'BaseSettingController@delete');


            Route::post('setting', 'SettingController@set');
            Route::put('setting/{iId}', 'SettingController@update');
            Route::delete('setting/{iId}', 'SettingController@delete');

        });

    });
});

