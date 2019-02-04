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

use social\album\app\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends SocialController
{

    /**
     * CHECK AUTH MIDDLEWARE
     *
     * AlbumController constructor.
     */
//    public function __construct()
//    {
//        if (!config('SocialImage.Check_Auth')) {
//            Auth::login(User::find(1), true);
//        } else {
//            $this->middleware('auth:api');
//        }
//    }

    /**
     * GET ALL ALBUMS
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $aAlbums = Album::with('images')
//            ->isActive(true)
//            ->isTrash(false)
//            ->withCacheCooldownSeconds(30)
            ->get();
        return response()->json($aAlbums, 200);
    }

    /**
     * GET ALBUM BY IMAGE
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($iId)
    {
        $oAlbum = Album::with('image')
            ->find($iId);
        return response()->json($oAlbum, 200);
    }

    /**
     * SET NEW ALBUM
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request)
    {

        $stitle = $request->json('title');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;

        $oAlbum = new Album();

        $oAlbum->title = $stitle;
        $oAlbum->is_active = $bIs_active;
        $oAlbum->save();

        return response()->json($oAlbum, 200);

    }

    /**
     * UPDATE ALBUM BY ID
     *
     * @param Request $request
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $iId)
    {
        $iId = (int)$iId;
        $sTitle = $request->json('title');
        $bIs_active = $request->json('is_active') != null ? $request->json('is_active') : true;
        $bIs_trash = $request->json('is_trash') != null ? $request->json('is_trash') : false;


        $oAlbum = Album::find($iId);

        $oAlbum->title = $sTitle;
        $oAlbum->is_active = $bIs_active;
        $oAlbum->is_trash = $bIs_trash;
        $oAlbum->save();

        return response()->json($oAlbum, 200);

    }

    /**
     * DELETE ALBUM BY ID
     *
     * @param int $iId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($iId)
    {
        $iId = (int)$iId;

        $oAlbum = Album::find($iId);
        $oAlbum->is_trash = true;
        $oAlbum->save();
        return response()->json($oAlbum, 200);

    }
}

