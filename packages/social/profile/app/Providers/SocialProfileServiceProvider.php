<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:05 PM
 */
namespace social\profile\app\Providers;

use social\profile\app\Services\SocialEmailService;
use social\profile\app\Services\SocialErrorService;
use social\profile\app\Services\SocialProfileService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use social\profile\app\Services\SocialService;


class SocialProfileServiceProvider extends ServiceProvider
{

    public function register()
    {

        // BIND Profile FACADE
        $this->app->bind('SocialProfile', function () {
            return new SocialProfileService();
        });
        $this->app->bind('SocialError', function () {
            return new SocialErrorService();
        });
        $this->app->bind('SocialEmail', function () {
            return new SocialEmailService();
        });
        $this->app->bind('SocialService', function () {
            return new SocialService();
        });

        //INSERT PACKAGE FACADES
        AliasLoader::getInstance()->alias('SocialProfile', \social\profile\app\Facades\SocialProfileFacade::class);
        AliasLoader::getInstance()->alias('SocialError', \social\profile\app\Facades\SocialErrorFacade::class);
        AliasLoader::getInstance()->alias('SocialEmail', \social\profile\app\Facades\SocialEmailFacade::class);
        AliasLoader::getInstance()->alias('SocialService', \social\profile\app\Facades\SocialServiceFacade::class);

        //INSERT PACKAGE CONFIG FILE
        $this->mergeConfigFrom(__DIR__ . '/../../config/SocialProfile.php', 'SocialProfile');

        //Register Dependence Packages
//        $this->app->register(\PulkitJalan\Cache\Providers\MultiCacheServiceProvider::class);
//        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
//        $this->app->register(\Intervention\Image\ImageServiceProvider::class);

        //insert dependency package Facades
        AliasLoader::getInstance()->alias('Image',\Intervention\Image\Facades\Image::class);


    }

    public function boot()
    {
        //INSERT PACKAGE ROUTES
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');


        //PUBLISH PACKAGE CONFIG FILE
        $this->publishes([__DIR__ . '/../../config' => config_path(),], 'Configs');
        $this->publishes([__DIR__.'/../../database/Seeds/Publishes' => database_path('seeds')],'Seeds');
        $this->publishes([__DIR__.'/../../resources/Publishes' => resource_path()],'Views');


        //INSERT PACKAGE VIEW FILE
//        $this->loadViewsFrom(__DIR__ . '/../../resources/Views', 'SocialProfile');
//        $this->loadViewsFrom(__DIR__ . '/../../resources/Emails', 'SocialEmail');
        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');


    }

}