<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/14/18
 * Time: 3:52 PM
 */

namespace social\album\app\Http\Controllers;

use App\User;
use social\core\app\Http\Controllers\SocialController;
use social\album\app\Models\Image as socialImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use SocialError;


class ImageController extends SocialController
{

    /**
     * CHECK AUTH MIDDLEWARE
     *
     * AlbumController constructor.
     */
    public function __construct()
    {
        Auth::user();
        if (!config('SocialImage.Check_Auth')) {
            Auth::login(User::find(1), true);
        } else {
            $this->middleware('auth:api');
        }
    }

    /**
     * GET ALL IMAGE
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $aImages = socialImage::with('album')
            ->get();
        return response()->json($aImages, 200);
    }

    /**
     * GET IMAGE BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($iId)
    {
        $iId = (int)$iId;

        $oImage = socialImage::with('album')
            ->find($iId);

        return response()->json($oImage, 200);
    }


    /**
     * SET NEW IMAGE
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request)
    {
        $iAlbum_id = $request->get('album_id');
        $iUser_id = Auth::user()->id;
        $fImage = $request->file('image');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $sPath = storage_path('images/' . $fImage->hashName());

        Image::make($fImage)->save($sPath);

        $oImage = new socialImage();
        $oImage->album_id = $iAlbum_id;
        $oImage->user_id = $iUser_id;
        $oImage->path = $sPath;
        $oImage->is_active = $bIs_active;

        $oImage->save();

        return response()->json($oImage, 200);
    }

    /**
     * UPDATE IMAGE BY ID
     *
     * @param Request $request
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $iId)
    {
        $iId = (int)$iId;
        $iAlbum_id = $request->get('album_id');
        $iUser_id = Auth::user()->id;
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;


        $oImage = socialImage::find($iId);

        if (config('SocialImage.Check_Owner')) {
            if ($oImage->user_id != Auth::user()->id) {
                SocialError::permission();
            }
        }

        if ($request->hasFile('image')) {
            $fImage = $request->file('image');
            $sAddress = storage_path('images/' . $fImage->hashName());
            Image::make($fImage)->save($sAddress);

            if (File::exists($oImage->address)) {
                $sOldAddress = $oImage->address;
                $sTrashAddress = storage_path('images/trash/' . basename($oImage->address));
                File::move($sOldAddress, $sTrashAddress);
            }

            $oImage->address = $sAddress;
        }

        $oImage->album_id = $iAlbum_id;
        $oImage->user_id = $iUser_id;
        $oImage->is_active = $bIs_active;
        $oImage->is_trash = $bIs_trash;
        $oImage->save();

        return response()->json($oImage, 200);

    }

    /**
     * DELETE IMAGE BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($iId)
    {
        $iId = (int)$iId;

        $oImage = socialImage::find($iId);

        if (config('SocialImage.Check_Owner')) {
            if ($oImage->user_id != Auth::user()->id) {
                SocialError::permission();
            }
        }

        if (File::exists($oImage->address)) {
            $sOldAddress = $oImage->address;
            $sTrashAddress = storage_path('images/trash/' . basename($oImage->address));
            File::move($sOldAddress, $sTrashAddress);
        }

        $oImage->is_trash = true;
        $oImage->save();

        return response()->json($oImage, 200);


    }

    /**
     * SHOW IMAGE
     *
     * @param int $iId
     *
     * @return mixed
     */
    public function show($iId)
    {
        $iId = (int)$iId;
        $oImage = SocialImage::find($iId);

        $fImage = Image::make($oImage->address);

        return $fImage->response('jpg');
    }
}

