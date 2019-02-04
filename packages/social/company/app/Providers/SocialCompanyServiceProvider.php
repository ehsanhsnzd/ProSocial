<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:05 PM
 */
namespace social\company\app\Providers;

use social\company\app\Services\SocialEmailService;
use social\company\app\Services\SocialErrorService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use social\company\app\Services\SocialCompanyService;



class SocialCompanyServiceProvider extends ServiceProvider
{

    public function register()
    {

        // BIND Company FACADE
        $this->app->bind('SocialCompany', function () {
            return new SocialCompanyService();
        });
        $this->app->bind('SocialError', function () {
            return new SocialErrorService();
        });
        $this->app->bind('SocialEmail', function () {
            return new SocialEmailService();
        });

        //INSERT PACKAGE FACADES
        AliasLoader::getInstance()->alias('SocialCompany', \social\company\app\Facades\SocialCompanyFacade::class);
        AliasLoader::getInstance()->alias('SocialError', \social\company\app\Facades\SocialErrorFacade::class);
        AliasLoader::getInstance()->alias('SocialEmail', \social\company\app\Facades\SocialEmailFacade::class);

        //INSERT PACKAGE CONFIG FILE
        $this->mergeConfigFrom(__DIR__ . '/../../config/SocialCompany.php', 'SocialCompany');

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/Views', 'SocialCompany');
        $this->loadViewsFrom(__DIR__ . '/../../resources/Emails', 'SocialEmail');
        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');

        $this->app->router->aliasMiddleware('CompanyAdmin', \social\company\app\Http\Middleware\CompanyAdmin::class);


    }

}