<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\profile\app\Http\Controllers\API;





use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use social\profile\app\Models\Notification;





class NotificationController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();
        return response()->json(DB::table('notifications')->where('notifiable_id',$user->id)->get(), $this-> successStatus);

    }

//    public function set(Request $request)
//    {
//        $user = Auth::user();
//        return response()->json($user, 200);
//    }



//    public function update(Request $request, $iId)
//    {
//        $iId = (int)$iId;
//
//        return response()->json($iId, 200);
//    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        Auth::user();

        $Notification= Notification::find($iId);
        $this->authorize('update_notification',$Notification);

        $Notification = $Notification->delete();

        return response()->json($Notification, 200);

    }

}