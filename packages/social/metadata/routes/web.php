<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:01 PM
 */

Route::group(['middleware' => ['MadMiddleware'], 'namespace' => 'social\metadata\app\Http\Controllers'], function () {
    Route::prefix('/Social/MetaData/')->middleware([])->group(function () {


    });
});