<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:58 PM
 */

namespace social\profile\app\Services;

use Exception;

class SocialErrorService extends SocialService {

    /**
     * RETURN PERMISSION DENIED ERROR
     *
     * @throws Exception
     */
    public function permission(){
        throw new Exception('permission denied' , 403);
    }

}