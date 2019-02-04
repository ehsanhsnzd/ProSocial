<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/14/18
 * Time: 3:52 PM
 */

namespace social\core\app\Http\Controllers;

use social\core\app\Exceptions\SocialException;
use Exception;
use Illuminate\Http\Request;
use social\core\app\Models\BaseSetting;
use social\core\app\Models\Setting;
use SocialService;
use App\Traits\ApiResponse;

class BaseSettingController extends SocialController
{
    use ApiResponse;

    public $successStatus = 200;
    public $errorStatus = 422;

    /**
     * GET ALL BASE SETTINGS
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {

        $aBaseSettings = BaseSetting::with('parent', 'children', 'settings')
//            ->withCacheCooldownSeconds(30)
            ->get();

        return response()->json($aBaseSettings, 200);
    }

    /**
     * GET BASE SETTING BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($iId)
    {

        $iId = (int)$iId;

        $oSocialSetting = BaseSetting::with('parent', 'children', 'settings')
//            ->isActive(true)
            ->isTrash(false)
//            ->withCacheCooldownSeconds(30)
            ->find($iId);
        return response()->json($oSocialSetting, 200);
    }

    public function settings($value)
    {
        $response = SocialService::getSettings($value);
        $this->setMeta('status', 'ok');
        $this->setData($value, $response);
        return response()->json($this->setResponse(), $this->successStatus);
    }

    /**
     * CREATE NEW BASE SETTING
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request)
    {

        $iBase_setting_id = $request->json('base_setting_id');
        $iParent_id = $request->json('parent_id');
        $sTitle = $request->json('title');
        $sDescription = $request->json('description');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;


        $oBaseSetting = new BaseSetting();

        $oBaseSetting->base_setting_id = $iBase_setting_id;
        $oBaseSetting->parent_id = $iParent_id;
        $oBaseSetting->title = $sTitle;
        $oBaseSetting->description = $sDescription;
        $oBaseSetting->is_active = $bIs_active;
        $oBaseSetting->is_trash = $bIs_trash;


        $oBaseSetting->save();
        return response()->json($oBaseSetting, 200);

    }

    /**
     * GET BASE SETTING AND UPDATE
     *
     * @param Request $request
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $iId)
    {

        $iBase_setting_id = $request->json('base_setting_id');
        $iParent_id = $request->json('parent_id');
        $sTitle = $request->json('title');
        $sDescription = $request->json('description');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;

        $oBaseSetting = BaseSetting::find($iId);

        $oBaseSetting->base_setting_id = $iBase_setting_id;
        $oBaseSetting->parent_id = $iParent_id;
        $oBaseSetting->title = $sTitle;
        $oBaseSetting->description = $sDescription;
        $oBaseSetting->is_active = $bIs_active;
        $oBaseSetting->is_trash = $bIs_trash;

        $oBaseSetting->save();

        return response()->json($oBaseSetting, 200);

    }

    /**
     * DELETE BASE SETTING
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete($iId)
    {
        $oBaseSetting = BaseSetting::find($iId);
        $oBaseSetting->is_trash = true;
        $oBaseSetting->save();
        return response()->json($oBaseSetting, 200);

    }

}