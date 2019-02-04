<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace social\core\app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use social\profile\app\Models\Profile;

class Admin {

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

        $User =Auth::user();
        if($User->userType->title == 'admin'){
            $response = $next($request);

            return response()->json(['data'=>$response->original],200);
        }else{
            return response()->json('Permission denied',404);
        }
    }

}