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
use social\company\app\Models\Category;
use social\company\app\Models\Company;
use social\company\app\Models\Service;
use SocialService;

class ServiceController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $category = Category::find($cId);

        return response()->json($category->services, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Service::where('service_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request,$cId)
    {

        $validator= SocialService::validator($request,[
            'service_type_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $cId= (int)$cId;
//        $company = Company::findOrFail($cId);
//        $this->authorize('update',$company);
        $service_type_id = $request->json('service_type_id');
        $category_id = $request->json('category_id');
        $title = $request->json('title');
        $description = $request->json('description');
        $price = $request->json('price');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $service = new Service();
        $service->company_id=$cId;
        $service->service_type_id = $service_type_id;
        $service->category_id = $category_id;
        $service->title = $title;
        $service->description = $description;
        $service->price = $price;
        $service->is_active = $pIs_active;

        $service->save();

        return response()->json($service, 200);
    }



    public function update(Request $request,$cId, $iId)
    {

        $validator= SocialService::validator($request,[
            'service_type_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $iId = (int)$iId;

        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);

        $company_id = $cId;
        $service_type_id = $request->json('service_type_id');
        $category_id = $request->json('category_id');
        $title = $request->json('title');
        $description = $request->json('description');
        $price = $request->json('price');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $service = Service::find($iId);
        $service->company_id=$company_id;
        $service->service_type_id = $service_type_id;
        $service->category_id = $category_id;
        $service->title = $title;
        $service->description = $description;
        $service->price = $price;
        $service->is_active = $pIs_active;

        $service->save();

        return response()->json($service, 200);

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

        $service = Service::find($iId)->delete();

        return response()->json($service, 200);

    }

}