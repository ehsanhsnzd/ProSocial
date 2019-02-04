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
use social\datas\app\Models\Project;
use social\datas\app\Models\Skill;
use SocialService;




class ProjectController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json(Project::all(), $this-> successStatus);

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
            'description' => 'required',
            'project_size_id' => 'required',
            'project_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $ptitle = $request->json('title');
        $pDescription =$request->json('description');
        $pSize = $request->json('project_size_id');
        $pType =$request->json('project_type_id');
        $pAlbum = $request->json('album_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $Project = new Project();
        $Project->title = $ptitle;
        $Project->description = $pDescription;
        $Project->project_size_id = $pSize;
        $Project->project_type_id = $pType;
        $Project->album_id = $pAlbum;
        $Project->is_active = $pIs_active;
        $Project->save();

        return response()->json($Project, 200);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
            'description' => 'required',
            'project_size_id' => 'required',
            'project_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $iId = (int)$iId;
        $ptitle = $request->json('title');
        $pDescription =$request->json('description');
        $pSize = $request->json('project_size_id');
        $pType =$request->json('project_type_id');
        $pAlbum = $request->json('album_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;


        $Project = Project::find($iId);
        $Project->title = $ptitle;
        $Project->description = $pDescription;
        $Project->project_size_id = $pSize;
        $Project->project_type_id = $pType;
        $Project->album_id = $pAlbum;
        $Project->is_active = $pIs_active;
        $Project->save();

        return response()->json($Project, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;
        $Project = Project::find($iId);


        $Project = $Project::find($iId)->delete();

        return response()->json($Project, 200);

    }

}