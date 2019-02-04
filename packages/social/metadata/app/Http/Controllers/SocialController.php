<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/14/18
 * Time: 3:53 PM
 */
namespace social\metadata\app\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


}