<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:10 PM
 */

namespace social\profile\app\Facades;



use Illuminate\Support\Facades\Facade;


class SocialErrorFacade extends Facade
{
    /**
     * SET Root FACADE
     *
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'SocialError';
    }
}