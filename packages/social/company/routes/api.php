<?php
/**
 * Created by PhpStorm.
 * User: Ehsan
 * Date: 8/11/18
 * Time: 4:01 PM
 */


Route::group(['namespace' => 'social\company\app\Http\Controllers\API','middleware' => 'auth:api'], function () {
    Route::prefix('/api/company/')->group(function () {
        Route::group(['middleware' => 'CompanyAdmin'], function () {
            Route::post('skill/{cId}', 'SkillController@set');
            Route::delete('skill/{cId}/{iId}', 'SkillController@delete');

            Route::post('project/{cId}', 'ProjectController@set');
            Route::post('setProject/{cId}', 'ProjectController@setTo');
            Route::put('project/{cId}/{iId}', 'ProjectController@update');
            Route::delete('project/{cId}/{iId}', 'ProjectController@delete');


            Route::put('detail/{iId}', 'CompanyController@update');
            Route::delete('detail/{iId}', 'CompanyController@delete');

            Route::post('service/{cId}', 'ServiceController@set');
            Route::put('service/{cId}/{iId}', 'ServiceController@update');
            Route::delete('service/{cId}/{iId}', 'ServiceController@delete');

            Route::post('project/{cId}', 'ProjectController@set');
            Route::put('project/{cId}/{iId}', 'ProjectController@update');
            Route::delete('project/{cId}/{iId}', 'ProjectController@delete');

            Route::post('need/{cId}', 'NeedController@set');
            Route::put('need/{cId}/{iId}', 'NeedController@update');
            Route::delete('need/{cId}/{iId}', 'NeedController@delete');

            Route::post('room/{cId}', 'CompanyRoomController@set');
            Route::put('room/{cId}/{iId}', 'CompanyRoomController@update');
            Route::delete('room/{cId}/{iId}', 'CompanyRoomController@delete');

            Route::post('category/{cId}', 'CategoryController@set');
            Route::put('category/{cId}/{iId}', 'CategoryController@update');
            Route::delete('category/{cId}/{iId}', 'CategoryController@delete');

            Route::post('admin/{cId}', 'CompanyAdminController@set');
            Route::delete('admin/{cId}/{iId}', 'CompanyAdminController@delete');
        });

            Route::post('detail/', 'CompanyController@set');

        });
    });


Route::group(['namespace' => 'social\company\app\Http\Controllers\API'], function () {
    Route::prefix('/api/company/')->group(function () {


        Route::get('detail/{iId}', 'CompanyController@get');

        Route::get('projects/{cId}', 'ProjectController@getAll');

        Route::get('skills/{cId}', 'SkillController@getAll');

        Route::get('services/{cId}', 'ServiceController@getAll');

        Route::get('projects/{cId}', 'ProjectController@getAll');

        Route::get('needs/{cId}', 'NeedController@getAll');

        Route::get('rooms/{cId}', 'CompanyRoomController@getAll');

        Route::get('categories/{cId}', 'CategoryController@getAll');

        Route::get('admin/{cId}', 'CompanyAdminController@getAll');

    });
});

