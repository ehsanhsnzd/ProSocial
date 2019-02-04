<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 3:00 PM
 */

namespace social\metadata\app\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Exception;
use SocialProfile;
use SocialError;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'UNauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        // CHECK Social IMAIL
        if (config('SocialMetaData.Social_Auth')){
            try {
                $sEmail = $request->get('email');
//                if (!preg_match("/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(Social)\.com$/", $sEmail)) {
//                    SocialError::permission();
//                }
            }catch (Exception $e){
                return response()->json($e->getMessage(),$e->getCode());
            }
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        //CREATE Social PROFILE
        if(config('SocialProfile.Active')){
            SocialProfile::createProfile($user);
            $user->sendEmailVerificationNotification();
        }
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    /**
     * VERIFY EMAIL
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function VerifyEmail(Request $request){
        $sToken = (String) $request->get('remomber_token');
        $oUser = User::where('remember_token',$sToken)->first();
        if ($oUser != null){
            $oUser->email_verified_at = date("Y-m-d h:i:s");
            $oUser->remember_token = '';
            $oUser->save();
            return response()->json(['success'=>true], 200);
        }else{
            return response()->json(['error'=>"These credentials do not match our records."],401);
        }
    }

    /**
     * RESET PASSWORD
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResetPassword(Request $request){
        $sToken = (String) $request->get('remomber_token');
        $sPassword = $request->get('password');
        $oUser = User::where('remember_token',$sToken)->first();
        if ($oUser != null){
            $oUser->email_verified_at = date("Y-m-d h:i:s");
            $oUser->password = bcrypt($sPassword);
            $oUser->remember_token = '';
            $oUser->save();
            return response()->json(['success'=>true], 200);
        }else{
            return response()->json(['error'=>"These credentials do not match our records."],401);
        }
    }

    public function ResetPasswordEmail(Request $request){
        $sEmail = $request->get('email');
        $oUser = User::where('email',$sEmail)->first();
        if ($oUser->id == null){
            return response()->json(['error'=>'We can\'t find a user with that e-mail address'], 401);
        }else{
            $oUser->remember_token = bcrypt($oUser->email);
            $oUser->save();
            $verify = $oUser->email_verified_at ? true : false;
            if($verify)
                $url = config('SocialMetaData.Client_Domain').'/resetPassword/?token='.$oUser->remember_token;
            else
                $url = config('SocialMetaData.Client_Domain').'/verifyEmail/?token='.$oUser->remember_token;

            dd($url);
            //todo send email
            return response()->json(['success'=>true], 200);
        }
    }
}