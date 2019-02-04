<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\profile\app\Http\Controllers\API;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;




class FollowController extends Controller

{
    use ApiResponse;
    public $successStatus = 200;
    public $errorStatus = 422;

    public function getAll()
    {
        $user = Auth::user();


        return response()->json($user->follows->pluck('company_id'), $this-> successStatus);

    }

    public function set(Request $request)
    {
        $user = Auth::user();

        $companyID = $request->json('to');

        $user->follows()->attach($companyID);

        return response()->json($user->follows, 200);
    }



//    public function update( $iId)
//    {
//
//        $iId = (int)$iId;
//        $this->authorize('update',$connection);
//        return response()->json($iId, 200);
//
//    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;

        $user = Auth::user();

        $user->follows()->detach($iId);

        return response()->json($user->follows, 200);

    }


}