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
use SocialService;

class CategoryController extends Controller
{
    public $successStatus = 200;

    public function getAll($cId)
    {
        $company = Company::find($cId);

        return response()->json($company->categories, $this-> successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;

        return response()->json(Category::where('category_id',$iId)->get(), $this-> successStatus);

    }

    public function set(Request $request,$cId)
    {

        $validator= SocialService::validator($request,[
            'title' => 'required',
            'category_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $cId = (int)$cId;
        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);

        $category_type_id = $request->json('category_type_id');
        $parent_id = $request->json('parent_id');
        $title = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $category = new Category();
        $category->category_type_id=$category_type_id;
        $category->company_id = $cId;
        $category->parent_id = $parent_id;
        $category->title = $title;
        $category->is_active = $pIs_active;

        $category->save();

        return response()->json($category, 200);
    }



    public function update(Request $request,$cId, $iId)
    {
        $validator= SocialService::validator($request,[
            'title' => 'required',
            'category_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $company = Company::findorfail($cId);
//        $this->authorize('update',$company);


        $category_type_id = $request->json('category_type_id');
        $company_id = $request->json('company_id');
        $parent_id = $request->json('parent_id');
        $title = $request->json('title');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $category = Category::find($iId);
        $category->category_type_id=$category_type_id;
        $category->company_id = $company_id;
        $category->parent_id = $parent_id;
        $category->title = $title;
        $category->is_active = $pIs_active;

        $category->save();

        return response()->json($category, 200);

    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($cId,$iId)
    {
        $iId = (int)$iId;

//        $company = Company::findorfail($cId);
        $this->authorize('update',$company);

        $category = Category::find($iId)->delete();

        return response()->json($category, 200);

    }

}