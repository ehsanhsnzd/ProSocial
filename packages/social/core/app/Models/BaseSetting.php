<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 4:10 PM
 */

namespace social\core\app\Models;


class  BaseSetting extends SocialModel {

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'base_settings';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'base_setting_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['base_setting_id','parent_id','title','description','is_active','is_trash','created_at' ,'updated_at'];

    /**
     * GET PARENT BASE SETTING
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(BaseSetting::class ,'parent_id' ,'base_setting_id');
    }

    /**
     * GET CHILDREN BASE SETTINGS
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany(BaseSetting::class ,'parent_id' ,'base_setting_id');
    }

    /**
     * GET SETTINGS
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(){
        return $this->hasMany(Setting::class,'base_setting_id','base_setting_id');
    }


}