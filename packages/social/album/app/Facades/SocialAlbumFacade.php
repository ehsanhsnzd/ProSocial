<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:10 PM
 */

namespace social\album\app\Facades;



use Illuminate\Support\Facades\Facade;


class SocialAlbumFacade extends Facade
{
    /**
     * SET Root FACADE
     *
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'SocialAlbum';
    }
}