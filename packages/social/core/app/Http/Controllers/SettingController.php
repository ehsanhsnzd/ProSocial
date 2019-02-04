<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/14/18
 * Time: 3:52 PM
 */

namespace social\core\app\Http\Controllers;

use App\Traits\ApiResponse;
use social\core\app\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends SocialController
{
    use ApiResponse;

    public $successStatus=200;
    public $errorStatus=422;

    /**
     * GET ALL SETTINGS
     */
    public function getAll()
    {
        $aSettings = Setting::with('parent', 'children', 'baseSetting')
            ->isActive(true)
            ->isTrash(false)
//            ->withCacheCooldownSeconds(30)
            ->get();
        return response()->json($aSettings, 200);
    }

    /**
     * GET SETTING BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($iId)
    {
        $iId = (int)$iId;

        $aSetting = Setting::with('parent', 'children', 'baseSetting')
            ->find($iId);
        $this->setMeta('status','ok');
        $this->setData('setting',$aSetting);
        return response()->json($this->setResponse(),$this->successStatus);
    }




    /**
     * SET NEW SETTING
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request)
    {

        $iSetting_id = $request->json('setting_id');
        $iBase_setting_id = $request->json('base_setting_id');
        $iParent_id = $request->json('parent_id');
        $sTitle = $request->json('title');
        $sDescription = $request->json('description');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;

        $oSetting = new Setting();

        $oSetting->setting_id = $iSetting_id;
        $oSetting->base_setting_id = $iBase_setting_id;
        $oSetting->parent_id = $iParent_id;
        $oSetting->title = $sTitle;
        $oSetting->description = $sDescription;
        $oSetting->is_active = $bIs_active;
        $oSetting->is_trash = $bIs_trash;

        $oSetting->save();

        return response()->json($oSetting, 200);

    }

    /**
     * UPDATE SETTING BY ID
     *
     * @param Request $request
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $iId)
    {

        $iId = (int)$iId;
        $iSetting_id = $request->json('setting_id');
        $iBase_setting_id = $request->json('base_setting_id');
        $iParent_id = $request->json('parent_id');
        $sTitle = $request->json('title');
        $sDescription = $request->json('description');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;

        $oSetting = Setting::find($iId);

        $oSetting->setting_id = $iSetting_id;
        $oSetting->base_setting_id = $iBase_setting_id;
        $oSetting->parent_id = $iParent_id;
        $oSetting->title = $sTitle;
        $oSetting->description = $sDescription;
        $oSetting->is_active = $bIs_active;
        $oSetting->is_trash = $bIs_trash;

        $oSetting->save();

        return response()->json($oSetting, 200);


    }

    /**
     * DELETE SETTING BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($iId)
    {
        $iId = (int)$iId;

        $oSetting = Setting::find($iId);

        $oSetting->is_trash = true;
        $oSetting->save();

        return response()->json($oSetting, 200);

    }
}