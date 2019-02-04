<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:05 PM
 */
namespace social\core\app\Providers;

use social\core\app\Services\SocialEmailService;
use social\core\app\Services\SocialErrorService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use social\core\app\Services\SocialCoreService;



class SocialCoreServiceProvider extends ServiceProvider
{

    public function register()
           {

        // BIND CORE FACADE
        $this->app->bind('SocialCore', function () {
            return new SocialCoreService();
        });
        $this->app->bind('SocialError', function () {
            return new SocialErrorService();
        });
        $this->app->bind('SocialEmail', function () {
            return new SocialEmailService();
        });

        //INSERT PACKAGE FACADES
        AliasLoader::getInstance()->alias('SocialCore', \social\core\app\Facades\SocialCoreFacade::class);
        AliasLoader::getInstance()->alias('SocialError', \social\core\app\Facades\SocialErrorFacade::class);
        AliasLoader::getInstance()->alias('SocialEmail', \social\core\app\Facades\SocialEmailFacade::class);

        //INSERT PACKAGE CONFIG FILE
        $this->mergeConfigFrom(__DIR__ . '/../../config/SocialCore.php', 'SocialCore');

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/Views', 'SocialCore');
        $this->loadViewsFrom(__DIR__ . '/../../resources/Emails', 'SocialEmail');
        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');

        // INSERT PACKAGE MIDDLEWARE
        $this->app->router->aliasMiddleware('SocialMiddleware', \social\core\app\Http\Middleware\SocialMiddleware::class);
        $this->app->router->aliasMiddleware('Cors',\social\core\app\Http\Middleware\Cors::class);
        $this->app->router->aliasMiddleware('Json',\social\core\app\Http\Middleware\Json::class);
        $this->app->router->aliasMiddleware('Admin', \social\core\app\Http\Middleware\Admin::class);
    }

}