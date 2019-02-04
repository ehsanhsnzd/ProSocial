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
use social\datas\app\Models\Skill;





class SkillController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json($user->skills, $this-> successStatus);

    }

//    public function get($iId)
//    {
//        $iId = (int)$iId;
//
//        return response()->json(Skill::where('skill_id',$iId)->get(), $this-> successStatus);
//
//    }

    public function set(Request $request)
    {
        $user = Auth::user();

        $skillID = $request->json('to');

        $user->skills()->sync($skillID);

        return response()->json($user->skills, 200);
    }


//
//    public function update(Request $request, $iId)
//    {
//
//
//        $iId = (int)$iId;
//        return response()->json($Skill, 200);
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

        $user->skills()->detach($iId);

        return response()->json($user->skills, 200);

    }

}