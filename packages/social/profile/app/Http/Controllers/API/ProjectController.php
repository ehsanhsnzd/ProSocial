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
use social\datas\app\Models\Project;
use SocialService;





class ProjectController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json($user->projects, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Project::where('project_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request)
    {
        $validator= SocialService::validator($request,[
            'project_size_id' => 'required',
            'project_type_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = Auth::user();


        $pSize = $request->json('project_size_id');
        $pType = $request->json('project_type_id');
        $pAlbum = $request->json('album_id');
        $ptitle = $request->json('title');
        $pDescription = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $project = new Project();
        $project->user_id=$user->id;
        $project->title = $ptitle;
        $project->description = $pDescription;
        $project->project_size_id = $pSize;
        $project->project_type_id = $pType;
        $project->album_id = $pAlbum;
        $project->is_active = $pIs_active;

        $project->save();

        $user->projects()->attach($project->project_id);


        return response()->json($user->projects, 200);
    }

    public function setTo(Request $request)
    {
        $user = Auth::user();


        $pto = $request->json('to');

        $user->projects()->attach($pto);


        return response()->json($user->projects, 200);
    }


    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'project_size_id' => 'required',
            'project_type_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $iId = (int)$iId;

        $pSize = $request->json('project_size_id');
        $pType = $request->json('project_type_id');
        $pAlbum = $request->json('album_id');
        $ptitle = $request->json('title');
        $pDescription = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $project = Project::find($iId);


        $this->authorize('update',$project);

        $project->title = $ptitle;
        $project->description = $pDescription;
        $project->project_size_id = $pSize;
        $project->project_type_id = $pType;
        $project->album_id = $pAlbum;
        $project->is_active = $pIs_active;

        return response()->json($project, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;
        $project = Project::find($iId);

        $this->authorize('update',$project);

        $project = $project::find($iId)->delete();

        return response()->json($project, 200);

    }

}