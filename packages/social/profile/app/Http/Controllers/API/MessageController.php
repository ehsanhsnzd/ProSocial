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
use social\core\app\Models\BaseSetting;
use social\profile\app\Models\Message;
use social\profile\app\Models\Notification;
use SocialService;



class MessageController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();
        $message = new Message();

        return response()->json( Message::groupBy('user_to_id')->get(), $this->successStatus);
    }

    public function getSent($iId)
    {
        $user = Auth::user();

        return response()->json( $user->sendBox, $this->successStatus);
    }

    public function getReceive($iId)
    {
        $user = Auth::user();

        return response()->json( $user->inBox, $this->successStatus);
    }

    public function getChat($iId)
    {
        $user = Auth::user();
        $iId=(int)$iId;
        return response()->json(
            Message::where('user_from_id',$user->id)
                    ->orWhere('user_to_id',$iId)->get(), $this->successStatus);
    }

    public function set(Request $request)
    {

        $validator= SocialService::validator($request,[
            'message' => 'required|max:255',
            'to' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = Auth::user();
        $userFrom = $user->id;

        $mMessage = $request->json('message');
        $mUserTo = $request->json('to');
        $mAlbum = $request->json('album_id');

        $user->messages()->attach($userFrom, ['user_to_id' => $mUserTo,'message' => $mMessage,'album_id' => $mAlbum]);

        SocialService::Notification($user,$userFrom,$mUserTo,['notification','message']);

        return response()->json(['success'=> ['to' => $mUserTo, 'message' => $mMessage]], 200);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'message' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $iId = (int)$iId;
        $user = Auth::user();

        $mMessage = $request->json('message');
        $mAlbum = $request->json('album_id');

        $Message = Message::find($iId);
        $this->authorize('update_from',$Message);

        $Message->message = $mMessage;
        $Message->album_id = $mAlbum;

        $Message->save();

        return response()->json(['success'=> $Message], 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {

        $iId = (int)$iId;
        $user = Auth::user();

        $Message = Message::find($iId);
        $this->authorize('update_from',$Message);

        $Message = $Message::find($iId)->delete();

        return response()->json(['success'=> $Message], 200);

    }

}