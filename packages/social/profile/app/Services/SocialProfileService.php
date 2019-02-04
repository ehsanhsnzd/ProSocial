<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:58 PM
 */

namespace social\profile\app\Services;

use App\User;
use social\profile\app\Models\Profile;
use SocialService;

class SocialProfileService extends SocialService {



    public function CreateProfile(User $user){
        $oProfile = new Profile();
        $oProfile->user()->associate($user);
        $oProfile->save();
        return $oProfile;

    }

    public function EditProfile($request, $iId)
    {
        $iId = (int)$iId;
        $iCountry_id = $request->json('country_id');
        $iState_id = $request->json('state_id');
        $iCity_id = $request->json('city_id');
        $iZip = $request->json('zip');
        $iDescription= $request->json('description');
//        $iAlbum_id = $request->json('album_id');
//        $iImage_id = $request->json('image_id');
        $iPhone = $request->json('phone');
        $iAddress = $request->json('address');




        $oProfile = Profile::where('user_id',$iId)->first();

        $oProfile->country_id = $iCountry_id;
        $oProfile->state_id = $iState_id;
        $oProfile->city_id = $iCity_id;
        $oProfile->zip = $iZip;
        $oProfile->description = $iDescription;
        $oProfile->phone = $iPhone;
        $oProfile->address = $iAddress;

        $oProfile->save();

        return $oProfile;
    }



}