<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace social\core\app\Http\Middleware;

use Closure;

class SocialMiddleware {

    /**
         * Social CORE MIDDLEWARE
     *
     * @param $request
     * @param Closure $next
     *
     * @return Closure
     */
    public function handle($request,Closure $next){

        return $next($request);

    }

}