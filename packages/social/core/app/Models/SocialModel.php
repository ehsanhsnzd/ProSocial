<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:24 PM
 */

namespace social\core\app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use social\core\app\builder\SocialBuilder as QueryBuilder;

class SocialModel extends Model {

    use Notifiable;
//    use Cachable;
//
//    public function __construct($attributes = [])
//    {
//        config(['laravel-model-caching.cache-prefix' => 'test-prefix']);
//
//        parent::__construct($attributes);
//    }


    /**
     * HIDDEN TABLE ITEMS
     *
     * @var array
     */
    protected $hidden = [
        'is_active','is_trash' ,'created_at' ,'updated_at'
    ];

    /**
     * GET ACTIVE ITEMS
     *
     * @param         $query
     * @param boolean $bActive
     *
     * @return mixed
     */
        protected function newBaseQueryBuilder()
        {
            $connection = $this->getConnection();

            return new QueryBuilder(
                $connection,$this->getTable(), $connection->getQueryGrammar(), $connection->getPostProcessor()
            );
        }




}