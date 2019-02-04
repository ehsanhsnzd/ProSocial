<?php

namespace social\profile\app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use social\profile\app\Models\Education;
use SocialService;
use App\Traits\ApiResponse;
class EducationController extends Controller
{
    use ApiResponse;
    public $successStatus = 200;
    public $errorStatus = 422;

    public function getAll()
    {
        $user = Auth::user();

        $this->setMeta('status', 'ok');
        $this->setData('jobs', $user->educations);
        return response()->json($this->setResponse(), $this->successStatus);

    }

    public function get($iId)
    {

        $iId = (int)$iId;
        $this->setMeta('status', 'ok');
        $this->setData('job', Education::where('education_id',$iId)->get());
        return response()->json($this->setResponse(), $this->successStatus);
    }

    public function set(Request $request)
    {
        $validator= SocialService::validator($request,[
            'school' => 'required',
            'field' => 'required',
            'grade' => 'required',
            'from_id' => 'required',
            'to_id' => 'required',
        ]);

        if ($validator->fails()) {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', $validator->errors());
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        $user = Auth::user();
        $userID = $user->id;

        $school = $request->json('school');
        $degree_id= $request->json('degree_id');
        $from = $request->json('from_id');
        $to = $request->json('to_id');
        $album= $request->json('album_id');
        $meta_data= $request->json('meta_data_id');
        $field= $request->json('field');
        $grade= $request->json('grade');
        $description= $request->json('description');
        $activity= $request->json('activity');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $Ed = new Education();
        $Ed->user_id = $userID;
        $Ed->school = $school;
        $Ed->degree_id = $degree_id;
        $Ed->from_id = $from;
        $Ed->to_id = $to;
        $Ed->album_id = $album;
        $Ed->meta_data_id = $meta_data;
        $Ed->field = $field;
        $Ed->grade = $grade;
        $Ed->description = $description;
        $Ed->activity = $activity;
        $Ed->activity = $pIs_active;
        $Ed->save();

        $this->setMeta('status', 'success');
        $this->setData('job',$Ed);
        return response()->json($this->setResponse(), $this->successStatus);
    }



    public function update(Request $request, $iId)
    {

        $validator= SocialService::validator($request,[
            'school' => 'required',
            'field' => 'required',
            'grade' => 'required',
            'from_id' => 'required',
            'to_id' => 'required',
        ]);


        if ($validator->fails()) {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', $validator->errors());
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        $iId = (int)$iId;
        $school = $request->json('school');
        $degree_id= $request->json('degree_id');
        $from = $request->json('from_id');
        $to = $request->json('to_id');
        $album= $request->json('album_id');
        $meta_data= $request->json('meta_data_id');
        $field= $request->json('field');
        $grade= $request->json('grade');
        $description= $request->json('description');
        $activity= $request->json('activity');
        $pIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;


        $Ed = Education::find($iId);
        $this->authorize('update',$Ed);

        $Ed->school = $school;
        $Ed->degree_id = $degree_id;
        $Ed->from_id = $from;
        $Ed->to_id = $to;
        $Ed->album_id = $album;
        $Ed->meta_data_id = $meta_data;
        $Ed->field = $field;
        $Ed->grade = $grade;
        $Ed->description = $description;
        $Ed->activity = $activity;
        $Ed->is_active = $pIs_active;
        $Ed->save();

        $this->setMeta('status', 'success');
        $this->setData('job',$Ed);
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
        $Ed = Education::find($iId);

        $this->authorize('update',$Ed);

        $Ed = $Ed::find($iId)->delete();

        $this->setMeta('status', 'success');
        $this->setData('job',$Ed);
        return response()->json($this->setResponse(), $this->successStatus);

    }

}
