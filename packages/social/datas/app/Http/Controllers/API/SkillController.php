<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\datas\app\Http\Controllers\API;





use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use social\datas\app\Models\Skill;
use SocialService;




class SkillController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json(Skill::all(), $this-> successStatus);

    }
//
//    public function get($iId)
//    {
//        $iId = (int)$iId;
//
//        return response()->json(Post::where('post_id',$iId)->get(), $this-> successStatus);
//
//    }

    public function set(Request $request)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $ptitle = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $Skill = new Skill();
        $Skill->title = $ptitle;
        $Skill->is_active = $pIs_active;
        $Skill->save();

        return response()->json($Skill, 200);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $iId = (int)$iId;
        $ptitle = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;


        $Skill = Skill::find($iId);
        $Skill->title = $ptitle;
        $Skill->is_active = $pIs_active;
        $Skill->save();

        return response()->json($Skill, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;
        $Skill = Skill::find($iId);


        $Skill = $Skill::find($iId)->delete();

        return response()->json($Skill, 200);

    }

}