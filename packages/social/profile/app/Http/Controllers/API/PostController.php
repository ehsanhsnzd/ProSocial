<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\profile\app\Http\Controllers\API;





use App\Notifications\NewPost;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use social\profile\app\Models\Post;
use SocialService;



class PostController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json($user->posts, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Post::where('post_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required|min:4',
            'description' => 'required|min:15',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = Auth::user();
        $userID = $user->id;

        $ptitle = $request->json('title');
        $pdescription = $request->json('description');
        $palbumID = $request->json('album_id');
        $scompanyID = $request->json('company_id');
        $sroomID= $request->json('company_room_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $Post = new Post();
        $Post->user_id = $userID;
        $Post->title = $ptitle;
        $Post->description = $pdescription;
        $Post->album_id = $palbumID;
        $Post->company_id = $scompanyID;
        $Post->company_room_id = $sroomID;
        $Post->is_active = $pIs_active;
        $Post->save();

//        SocialService::Notification($user,$ptitle,$connections,['notification','post']);

        Notification::send($user->connections, new NewPost($Post));
        return response()->json($Post, 200);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required|min:4',
            'description' => 'required|min:15',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $iId = (int)$iId;
        $ptitle = $request->json('title');
        $pdescription = $request->json('description');
        $palbumID = $request->json('album_id');
        $scompanyID = $request->json('company_id');
        $sroomID= $request->json('company_room_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;


        $Post = Post::find($iId);
        $this->authorize('update',$Post);

        $Post->title = $ptitle;
        $Post->description = $pdescription;
        $Post->album_id = $palbumID;
        $Post->company_id = $scompanyID;
        $Post->company_room_id = $sroomID;
        $Post->is_active = $pIs_active;
        $Post->save();

        return response()->json($Post, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;
        $Post = Post::find($iId);

        $this->authorize('update',$Post);

        $Post = $Post::find($iId)->delete();
        $notification= new \social\profile\app\Models\Notification();
        $notification->whereRaw("JSON_EXTRACT(`data`, '$.post_id') = ?", $iId)->delete();
        return response()->json($Post, 200);



    }

}