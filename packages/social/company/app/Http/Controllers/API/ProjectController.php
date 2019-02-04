<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 30/12/2018
 * Time: 11:34 AM
 */


namespace social\company\app\Http\Controllers\API;





use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use social\company\app\Models\Company;
use social\datas\app\Models\Project;
use SocialService;





class ProjectController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $company = Company::find($cId);

        return response()->json($company->projects, $this-> successStatus);

    }
//
//    public function get($iId)
//    {
//        $iId = (int)$iId;
//
//        return response()->json(Project::where('project_id',$iId)->get(), $this-> successStatus);
//
//    }

    public function set(Request $request,$cId)
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
        $company = Company::findOrFail($cId);
//        $this->authorize('update',$company);

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

        $company->projects()->attach($project->project_id);


        return response()->json($company->projects, 200);
    }

    public function setTo(Request $request,$cId)
    {

        $company = Company::find($cId);
//        $this->authorize('update',$company);

        $pto = $request->json('to');
        $company->projects()->attach($pto);


        return response()->json($company->projects, 200);
    }


    public function update(Request $request,$cId, $iId)
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

        $company = Company::find($cId);
//        $this->authorize('update',$company);

        $project = Project::find($iId);

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
    public function delete($cId,$iId)
    {
        $iId = (int)$iId;

        $company = Company::find($cId);
//        $this->authorize('update',$company);

        $company->projects()->detach();
        $project = Project::find($iId)->delete();

        return response()->json($project, 200);

    }

}