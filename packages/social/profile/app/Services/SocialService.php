<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/13/18
 * Time: 2:54 PM
 */

namespace social\profile\app\Services;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use social\core\app\Models\BaseSetting;
use social\profile\app\Models\Notification;
use Validator;

class SocialService{


    public function validator(Request $request,$validate)
    {
        $messages_err= config(config('SocialCore.Language.message'));
        $attributes_err=config(config('SocialCore.Language.attribute'));
        return $validator = Validator::make($request->all(), $validate ,$messages_err,$attributes_err );
    }

    public function Msg($value,$Suc=false)
    {
        if($Suc){
            $messages_err = config(config('SocialCore.Language.message').'.'.$value).config(config('SocialCore.Language.message').'.'.$Suc);
        }else{
            $messages_err = config(config('SocialCore.Language.message').'.'.$value);
        }
        return $messages_err;
    }

    public function getSettingID($base,$setting)
    {

        $base= BaseSetting::where('title',$base)->first();
        $getSetting = $base->settings->where('title',$setting)->first();


        if ($getSetting) {
            return  $getSetting->setting_id ;
        } else {
            return die(response()->json(['There is no settings for '=> ['Setting' => $setting]]));
        }
    }

    public function getSettings($base)
    {

        $base= BaseSetting::where('title',$base)->first();
        return  $base->settings;

    }

    public function Notification (User $user,$title,$to,array $setting)
    {
        $notification= new Notification();
        $notification->title=$title;
        $notification->user_id=$to;
        $notification->type_id= $this->getSettingID($setting[0],$setting[1]);
        $user->notifications()->save($notification);
    }
}