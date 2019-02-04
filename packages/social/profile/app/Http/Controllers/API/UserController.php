<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 3:00 PM
 */

namespace social\profile\app\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Validator;
use Exception;
use SocialProfile;
use SocialError;
use SocialService;

class UserController extends Controller
{

    use ApiResponse;
    public $successStatus = 200;
    public $errorStatus = 422;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            $this->setMeta('status', 'ok');
            $this->setMeta('message', SocialService::Msg('login', 'success'));
            $this->setData('token', $token);
            $this->setData('user', $user);
            return response()->json($this->setResponse(), $this->successStatus);
        } else {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', ['login'=>SocialService::Msg('Unauthorised')]);
            return response()->json($this->setResponse(), 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = SocialService::validator($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        $this->setMeta('status', 'fail');
        $this->setMeta('message', $validator->errors());
        if ($validator->fails()) {
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        // CHECK Social IMAIL
        if (config('SocialCore.Social_Auth')) {
            try {
                $sEmail = $request->get('email');
//                if (!preg_match("/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(Social)\.com$/", $sEmail)) {
//                    SocialError::permission();
//                }
            } catch (Exception $e) {
                return response()->json($e->getMessage(), $e->getCode());
            }
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);


        //CREATE Social PROFILE
        if (config('SocialProfile.Active')) {
            SocialProfile::CreateProfile($user);
            $user->sendEmailVerificationNotification();
        }


        $this->setMeta('status', 'success');
        $this->setMeta('message', SocialService::Msg('register', 'success'));
        $this->setData('token', $user->createToken('MyApp')->accessToken);
        $this->setData('user', $user);
        return response()->json($this->setResponse(), $this->successStatus);


    }


    public function UpdateUser(Request $request, $iId)
    {
        $iId = (int)$iId;

        $validator = SocialService::validator($request, [
            'name' => 'required',
            'c_password' => 'same:password',
        ]);
        $this->setMeta('status', 'fail');
        $this->setMeta('message', $validator->errors());
        if ($validator->fails()) {
            return response()->json($this->setResponse(), $this->errorStatus);
        }


        $name = $request->json('name');
        $last_name = $request->json('last_name');
        $old_password = $request->json('old_password');
        $new_password = $request->json('password');


        $user = User::findOrFail($iId);
//        $this->authorize('update_user',$user);

        $user->name = $name;
        $user->last_name = $last_name;
        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($new_password);

            $this->setMeta('status', 'success');
            $this->setMeta('message', ['password' => SocialService::Msg('pwd', 'successChange')]);
            $status = $this->successStatus;
        } elseif (empty($old_password)) {

            $this->setMeta('status', 'success');
            $this->setMeta('message', ['password' => SocialService::Msg('user', 'successChange')]);
            $status = $this->successStatus;
        } else {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', ['password' => [SocialService::Msg('pwdIncorrect')]]);
            $status = $this->errorStatus;
        }
        $user->save();


        return response()->json($this->setResponse(), $status);

    }

    public function UpdateProfile(request $request, $iId)
    {

        $validator = SocialService::validator($request, [
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required'
        ]);
        $this->setMeta('status', 'fail');
        $this->setMeta('message', $validator->errors());
        if ($validator->fails()) {
            return response()->json($this->setResponse(), $this->errorStatus);
        }

        $res = SocialProfile::EditProfile($request, $iId);
        $this->setMeta('status', 'success');
        $this->setMeta('data', $res);
        return response()->json($this->setResponse(), $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        $this->setMeta('status', 'ok');
        $this->setData('user', User::where('id', $user->id)->with(['image', 'messengers'])->first());
        return response()->json($this->setResponse(), $this->successStatus);
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $this->setMeta('status', 'ok');
        $this->setData('user', $profile->user_details);
        return response()->json($this->setResponse(), $this->successStatus);
    }


    /**
     * VERIFY EMAIL
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function VerifyEmail(Request $request)
    {
        $sToken = (String)$request->get('remomber_token');
        $oUser = User::where('remember_token', $sToken)->first();
        if ($oUser != null) {
            $oUser->email_verified_at = date("Y-m-d h:i:s");
            $oUser->remember_token = '';
            $oUser->save();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => "These credentials do not match our records."], 401);
        }
    }

    /**
     * RESET PASSWORD
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResetPassword(Request $request)
    {
        $sToken = (String)$request->get('remember_token');
        $sPassword = $request->get('password');
        $oUser = User::where('remember_token', $sToken)->first();
        if ($oUser != null) {
            $oUser->email_verified_at = date("Y-m-d h:i:s");
            $oUser->password = bcrypt($sPassword);
            $oUser->remember_token = '';
            $oUser->save();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => "These credentials do not match our records."], 401);
        }
    }

    public function ResetPasswordEmail(Request $request)
    {
        $sEmail = $request->get('email');
        $oUser = User::where('email', $sEmail)->first();
        if ($oUser->id == null) {
            return response()->json(['error' => 'We can\'t find a user with that e-mail address'], 401);
        } else {
            $oUser->remember_token = bcrypt($oUser->email);
            $oUser->save();
            $verify = $oUser->email_verified_at ? true : false;
            if ($verify)
                $url = config('SocialCore.Client_Domain') . '/resetPassword/?token=' . $oUser->remember_token;
            else
                $url = config('SocialCore.Client_Domain') . '/verifyEmail/?token=' . $oUser->remember_token;

            dd($url);
            //todo send email
            return response()->json(['success' => true], 200);
        }
    }
}