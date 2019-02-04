<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:58 PM
 */

namespace social\profile\app\Services;

use App\User;
use social\profile\app\Mail\WelcomeToSocial;
use Exception;
use Illuminate\Support\Facades\Mail;

class SocialEmailService extends SocialService {

    /**
     * SEND WELCOME EMAIL
     */
    public function welcome(User $user){
        Mail::to($user->email)->send(new WelcomeToSocial());
    }

}