<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:05 PM
 */
namespace social\album\app\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use social\album\app\Services\SocialAlbumService;



class SocialAlbumServiceProvider extends ServiceProvider
{

    public function register()
    {

        // BIND Album FACADE
        $this->app->bind('SocialAlbum', function () {
            return new SocialAlbumService();
        });


        //INSERT PACKAGE FACADES
        AliasLoader::getInstance()->alias('SocialAlbum', \social\album\app\Facades\SocialAlbumFacade::class);

        //INSERT PACKAGE CONFIG FILE
        $this->mergeConfigFrom(__DIR__ . '/../../config/SocialAlbum.php', 'SocialAlbum');



    }

    public function boot()
    {
        //INSERT PACKAGE ROUTES
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');


        //PUBLISH PACKAGE CONFIG FILE
        $this->publishes([__DIR__ . '/../../config' => config_path(),], 'Configs');
        $this->publishes([__DIR__.'/../../database/Seeds/Publishes' => database_path('seeds')],'Seeds');


        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');


    }

}