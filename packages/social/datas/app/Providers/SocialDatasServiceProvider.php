<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:05 PM
 */
namespace social\datas\app\Providers;

use social\datas\app\Services\SocialEmailService;
use social\datas\app\Services\SocialErrorService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use social\datas\app\Services\SocialDatasService;



class SocialDatasServiceProvider extends ServiceProvider
{

    public function register()
    {

        // BIND Datas FACADE
        $this->app->bind('SocialDatas', function () {
            return new SocialDatasService();
        });
        $this->app->bind('SocialError', function () {
            return new SocialErrorService();
        });
        $this->app->bind('SocialEmail', function () {
            return new SocialEmailService();
        });

        //INSERT PACKAGE FACADES
        AliasLoader::getInstance()->alias('SocialDatas', \social\datas\app\Facades\SocialDatasFacade::class);
        AliasLoader::getInstance()->alias('SocialError', \social\datas\app\Facades\SocialErrorFacade::class);
        AliasLoader::getInstance()->alias('SocialEmail', \social\datas\app\Facades\SocialEmailFacade::class);

        //INSERT PACKAGE CONFIG FILE
        $this->mergeConfigFrom(__DIR__ . '/../../config/SocialDatas.php', 'SocialDatas');

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/Views', 'SocialDatas');
        $this->loadViewsFrom(__DIR__ . '/../../resources/Emails', 'SocialEmail');
        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');


    }

}