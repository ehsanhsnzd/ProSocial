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
use SocialService;

class CompanyController extends Controller
{
    public $successStatus = 200;

    public function getAll()
    {
        $user = Auth::user();

        return response()->json($user->follows, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Company::where('company_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request)
    {


        $validator= SocialService::validator($request,[
            'company_size_id' => 'required',
            'company_type_id' => 'required',
            'title' => 'required',
            'page_name' => 'required',
            'website' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = Auth::user();

        $company_size_id = $request->json('company_size_id');
        $image_id = $request->json('image_id');
        $album_id = $request->json('album_id');
        $company_type_id = $request->json('company_type_id');
        $meta_data_id = $request->json('meta_data_id');
        $category_id = $request->json('category_id');
        $title = $request->json('title');
        $page_name = $request->json('page_name');
        $website = $request->json('website');
        $description = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $company = new Company();
        $company->user_id=$user->id;
        $company->company_size_id=$company_size_id;
        $company->image_id = $image_id;
        $company->album_id = $album_id;
        $company->company_type_id = $company_type_id;
        $company->meta_data_id = $meta_data_id;
//        $company->category_id = $category_id;
        $company->title = $title;
        $company->page_name = $page_name;
        $company->website = $website;
        $company->description = $description;
        $company->is_active = $pIs_active;

        $company->save();

        $user->follows()->attach($company->company_id);
        $user->CompanyAdmin()->attach($company->company_id);
        return response()->json($company, 200);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'company_size_id' => 'required',
            'company_type_id' => 'required',
            'title' => 'required',
            'page_name' => 'required',
            'website' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $company_size_id = $request->json('company_size_id');
        $image_id = $request->json('image_id');
        $album_id = $request->json('album_id');
        $company_type_id = $request->json('company_type_id');
        $meta_data_id = $request->json('meta_data_id');
        $category_id = $request->json('category_id');
        $title = $request->json('title');
        $page_name = $request->json('page_name');
        $website = $request->json('website');
        $description = $request->json('description');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $company = Company::find($iId);
//        $this->authorize('update',$company);

        $company->company_size_id=$company_size_id;
        $company->image_id = $image_id;
        $company->album_id = $album_id;
        $company->company_type_id = $company_type_id;
        $company->meta_data_id = $meta_data_id;
        $company->category_id = $category_id;
        $company->title = $title;
        $company->page_name = $page_name;
        $company->website = $website;
        $company->description = $description;
        $company->is_active = $pIs_active;

        $company->save();

        return response()->json($company, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {


        $iId = (int)$iId;
        $user=Auth::user();

        $company = Company::find($iId);
//        $this->authorize('update',$company);

        $company->skills()->detach();
        $company->projects()->detach();
        $user->follows()->detach($iId);
        $company = Company::find($iId)->delete();

        return response()->json($company, 200);

    }

}