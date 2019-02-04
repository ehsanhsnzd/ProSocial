<?php
/**
 * Created by PhpStorm.
 * User: Ehsan
 * Date: 8/11/18
 * Time: 4:01 PM
 */


Route::group(['namespace' => 'social\datas\app\Http\Controllers\API'], function () {
    Route::prefix('/social/data/api/')->middleware(['Cors','Json'])->group(function () {

        Route::group(['middleware' => ['auth:api','Admin']], function(){


            Route::get('skills','SkillController@getAll');
            Route::get('skill/{iId}','SkillController@get');
            Route::post('skill','SkillController@set');
            Route::put('skill/{iId}','SkillController@update');
            Route::delete('skill/{iId}','SkillController@delete');


        });


        Route::group(['middleware' => ['auth:api']], function(){


            Route::get('projects','ProjectController@getAll');
            Route::get('project/{iId}','ProjectController@get');
            Route::post('project','ProjectController@set');
            Route::put('project/{iId}','ProjectController@update');
            Route::delete('project/{iId}','ProjectController@delete');

        });

    });
});