<?php

namespace social\profile\app\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use social\profile\app\Models\Profile;


class ProfileController extends Controller
{
    public function getAll()
    {
        $Profile = new Profile();
        return   $Profile->with('user','messengers','jobs','educations','skills')->get();

    }
}
