<?php
/**
 * Created by PhpStorm.
 * User: Ehsan
 * Date: 8/11/18
 * Time: 4:01 PM
 */


Route::group(['namespace' => 'social\album\app\Http\Controllers'], function () {
    Route::prefix('/social/photo/api/')->middleware(['Cors','Json'])->group(function () {


//        Route::group(['middleware' => ['auth:api','verified']], function(){
//
//        });

        Route::get('albums','AlbumController@getAll');
        Route::get('album/{iId}','AlbumController@get');
        Route::post('album','AlbumController@set');
        Route::put('album/{iId}','AlbumController@update');
        Route::delete('album/{iId}','AlbumController@delete');

        Route::get('images','ImageController@getAll');
        Route::get('image/{iId}','ImageController@get');
        Route::post('image','ImageController@set');
        Route::put('image/{iId}','ImageController@update');
        Route::delete('image/{iId}','ImageController@delete');

        Route::get('show/{iId}','ImageController@show');

    });
});