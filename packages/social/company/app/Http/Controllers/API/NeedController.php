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
use social\company\app\Models\Need;
use SocialService;

class NeedController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $company = Company::find($cId);

        return response()->json($company->needs, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Need::where('need_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request,$cId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $cId=(int)$cId;
        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);

        $company_id = $cId;
        $dependency = $request->json('dependency');
        $title = $request->json('title');
        $description = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $need = new Need();
        $need->company_id=$company_id;
        $need->dependency = $dependency;
        $need->title = $title;
        $need->description = $description;
        $need->is_active = $pIs_active;

        $need->save();

        $skillID = $request->json('skill');

        $need->skills()->attach($skillID);


        SocialService::Notification($user,$title,$userID,['notification','need']);
        return response()->json($need->skills, 200);
    }



    public function update(Request $request,$cId, $iId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $iId = (int)$iId;

        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);

        $company_id = $cId;
        $dependency = $request->json('dependency');
        $title = $request->json('title');
        $description = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $need = Need::find($iId);
        $need->company_id=$company_id;
        $need->dependency = $dependency;
        $need->title = $title;
        $need->description = $description;
        $need->is_active = $pIs_active;

        $need->save();

        $skillID = $request->json('skill');

        $need->skills()->attach($skillID);

        return response()->json($need->skills, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($cId,$iId)
    {
        $iId = (int)$iId;

        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);

        $need = Need::find($iId)->delete();

        return response()->json($need, 200);

    }

}