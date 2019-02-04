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
use social\company\app\Models\Company;



class CompanyAdminController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $company = Company::find($cId);

        return response()->json($company->CompanyAdmin, $this-> successStatus);

    }

//    public function get($iId)
//    {
//        $iId = (int)$iId;
//
//        return response()->json(Skill::where('skill_id',$iId)->get(), $this-> successStatus);
//
//    }

    public function set(Request $request,$cId)
    {

        $company = Company::findOrFail($cId);
        $this->authorize('update',$company);

        $userID = $request->json('user');

        $company->CompanyAdmin()->attach($userID);

        return response()->json($company->CompanyAdmin, 200);
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
    public function delete($cId,$iId)
    {
        $iId = (int)$iId;
        $company = Company::findorFail($cId);
        $this->authorize('update',$company);

        $company->CompanyAdmin()->detach($iId);

        return response()->json($company->CompanyAdmin, 200);

    }

}