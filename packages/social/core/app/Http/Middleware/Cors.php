<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace social\core\app\Http\Middleware;

use Closure;

class Cors {

    /**
     * CREATE CORS MIDDLEWARE
     *
     * @param $request
     * @param Closure $next
     *
     * @return Closure
     */

    public function handle($request, Closure $next)
    {

        if ($request->getMethod() === "OPTIONS") {
            return response()->json(['success'=>'ok'],200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Authorization');
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Authorization');
    }

}