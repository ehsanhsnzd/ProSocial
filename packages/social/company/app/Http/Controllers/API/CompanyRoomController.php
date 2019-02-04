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
use social\company\app\Models\CompanyRoom;
use SocialService;

class CompanyRoomController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $company = Company::find($cId);

        return response()->json($company->rooms, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(CompanyRoom::where('company_room_id',$iId)->get(), $this-> successStatus);

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
        $company=Company::findorfail($cId);
//        $this->authorize('update',$company);

        $company_id = $cId;
        $title = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $room = new CompanyRoom();
        $room->company_id=$company_id;
        $room->title=$title;
        $room->is_active = $pIs_active;

        $room->save();

        return response()->json($room, 200);
    }



    public function update(Request $request,$cId, $iId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $company = Company::find($cId);
//        $this->authorize('update',$company);

        $company_id = $cId;
        $title = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $room = CompanyRoom::findorfail($iId);
        $room->company_id=$company_id;
        $room->title=$title;
        $room->is_active = $pIs_active;

        $room->save();

        return response()->json($room, 200);

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
        $room = CompanyRoom::findorfail($iId)->delete();

        return response()->json($room, 200);

    }

}