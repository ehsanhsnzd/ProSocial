<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\core\app\Models\Setting;

class Notification extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['id' ,'type','notifiable_type','notifiable_id','data','read_at','created_at' ,'updated_at'];



}