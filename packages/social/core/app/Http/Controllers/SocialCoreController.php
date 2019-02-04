<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/14/18
 * Time: 3:52 PM
 */
namespace social\core\app\Http\Controllers;
use Illuminate\Http\Request;
use SocialEmail;
use Illuminate\Support\Facades\Auth;

class SocialCoreController extends SocialController
{
    public function test(Request $request){


        SocialEmail::welcome(Auth::user());

        return response()->json("ok",200,['token'=>'123456']);

    }
}