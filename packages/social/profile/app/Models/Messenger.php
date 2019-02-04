<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\core\app\Models\Setting;

class messenger extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'messengers';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'messenger_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['user_id','type_id','messenger_value','is_active','created_at' ,'updated_at'];


    public function type(){
        return $this->belongsTo(Setting::class,'type_id','setting_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Profiles
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
