<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Image;

class Connection extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'connections';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'connection_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['user_from_id','user_to_id','is_blocked','is_accept' ,'is_active','created_at' ,'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Profiles
     */


}