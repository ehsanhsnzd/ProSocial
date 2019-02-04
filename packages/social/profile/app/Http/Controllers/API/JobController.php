<?php

namespace social\profile\app\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use social\profile\app\Models\Job;
use SocialService;
use App\Traits\ApiResponse;

class JobController extends Controller
{
    use ApiResponse;
    public $successStatus = 200;
    public $errorStatus = 422;

    public function getAll()
    {
        $user = Auth::user();
        $this->setMeta('status', 'ok');
        $this->setData('jobs', $user->jobs);
        return response()->json($this->setResponse(), $this->successStatus);

    }

    public function get($iId)
    {
        $iId = (int)$iId;
        $this->setMeta('status', 'ok');
        $this->setData('job', Job::where('job_id', $iId)->get());
        return response()->json($this->setResponse(), $this->successStatus);

    }

    public function set(Request $request)
    {

        $validator = SocialService::validator($request, [
            'title' => 'required',
            'description' => 'required',
            'company_name' => 'required',
            'job_type_id' => 'required',
            'job_from_id' => 'required',
            'job_to_id' => 'required',
            'city_id' => 'required',

        ]);
        if ($validator->fails()) {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', $validator->errors());
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        $user = Auth::user();
        $userID = $user->id;

        $ptitle = $request->json('title');
        $pdescription = $request->json('description');
        $pheadline = $request->json('headline');
        $pcompanyName = $request->json('company_name');
        $pcurrently = $request->json('currently');
        $ptype = $request->json('job_type_id');
        $pfrom = $request->json('job_from_id');
        $pto = $request->json('job_to_id');
        $pcity = $request->json('city_id');
        $palbumID = $request->json('album_id');
        $scompanyID = $request->json('company_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $Job = new Job();
        $Job->user_id = $userID;
        $Job->title = $ptitle;
        $Job->description = $pdescription;
        $Job->headline = $pheadline;
        $Job->company_name = $pcompanyName;
        $Job->currently = $pcurrently;
        $Job->job_from_id = $pfrom;
        $Job->job_to_id = $pto;
        $Job->city_id = $pcity;
        $Job->job_type_id = $ptype;
        $Job->album_id = $palbumID;
        $Job->company_id = $scompanyID;
        $Job->is_active = $pIs_active;
        $Job->save();

        $this->setMeta('status', 'success');
        $this->setData('job',$Job);
        return response()->json($this->setResponse(), $this->successStatus);

    }


    public function update(Request $request, $iId)
    {

        $validator = SocialService::validator($request, [
            'title' => 'required',
            'description' => 'required',
            'company_name' => 'required',
            'job_type_id' => 'required',
            'job_from_id' => 'required',
            'job_to_id' => 'required',
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', $validator->errors());
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        $iId = (int)$iId;
        $ptitle = $request->json('title');
        $pdescription = $request->json('description');
        $pheadline = $request->json('headline');
        $pcompanyName = $request->json('company_name');
        $pcurrently = $request->json('currently');
        $ptype = $request->json('job_type_id');
        $pfrom = $request->json('job_from_id');
        $pto = $request->json('job_to_id');
        $pcity = $request->json('city_id');
        $palbumID = $request->json('album_id');
        $scompanyID = $request->json('company_id');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;


        $Job = Job::find($iId);
        $this->authorize('update', $Job);


        $Job->title = $ptitle;
        $Job->description = $pdescription;
        $Job->headline = $pheadline;
        $Job->company_name = $pcompanyName;
        $Job->currently = $pcurrently;
        $Job->job_from_id = $pfrom;
        $Job->job_to_id = $pto;
        $Job->city_id = $pcity;
        $Job->job_type_id = $ptype;
        $Job->album_id = $palbumID;
        $Job->company_id = $scompanyID;
        $Job->is_active = $pIs_active;
        $Job->save();

        $this->setMeta('status', 'success');
        $this->setData('job',$Job);
        return response()->json($this->setResponse(), $this->successStatus);


    }

    /**
     * @param $iId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($iId)
    {
        $iId = (int)$iId;
        $Job = Job::find($iId);

        $this->authorize('update', $Job);

        $Job = $Job::find($iId)->delete();

        $this->setMeta('status', 'success');
        $this->setData('job',$Job);
        return response()->json($this->setResponse(), $this->successStatus);


    }
}
