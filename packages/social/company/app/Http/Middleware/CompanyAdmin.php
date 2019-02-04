<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace social\company\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use social\profile\app\Models\Profile;

class CompanyAdmin {

    /**
     * CREATE CORS MIDDLEWARE
     *
     * @param $request
     * @param Closure $next
     *
     * @return Closure
     */

    public function handle(Request $request , Closure $next)
    {
        $cId = $request->route('cId');
        $User =Auth::user();

        if(collect($User->CompanyAdmin)->where('company_id',$cId)->first()){
            $response = $next($request);

            return response()->json(['data'=>$response->original],200);
        }else{
            return response()->json('Permission denied',404);
        }
    }

}