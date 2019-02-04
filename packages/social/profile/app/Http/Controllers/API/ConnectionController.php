<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\profile\app\Http\Controllers\API;




use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;


class ConnectionController extends Controller

{
    use ApiResponse;

    public $successStatus = 200;
    public $errorStatus = 422;

    public function getAll()
    {
        $user = Auth::user();
        $this->setMeta('status', 'ok');
        $this->setData('connections', $user->connections);
        return response()->json($this->setResponse(), $this->successStatus);


    }


        public function set(Request $request)
    {
        $user = Auth::user();

        $connectTO = $request->json('to');

        $user->connections()->attach($connectTO);

        $this->setMeta('status', 'success');
        $this->setData('connection',$user->connections);
        return response()->json($this->setResponse(), $this->successStatus);


    }


//
//    public function update( $iId)
//    {
//
//        $iId = (int)$iId;
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

        $user->conncetions()->detach($iId);

        $this->setMeta('status', 'success');
        $this->setData('connection',$user->conncetions);
        return response()->json($this->setResponse(), $this->successStatus);

    }


}