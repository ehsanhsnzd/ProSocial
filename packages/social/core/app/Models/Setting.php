<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 4:48 PM
 */
namespace social\core\app\Models;

class Setting extends SocialModel{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'setting_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['base_setting_id','setting_id','parent_id','title','description','is_active','is_trash','created_at' ,'updated_at'];

    /**
     * GET PARENT SETTING
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(Setting::class ,'parent_id' ,'setting_id');
    }

    /**
     * GET CHILDREN SETTINGS
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany(Setting::class ,'parent_id' ,'setting_id');
    }

    /**
     * GET BASE SETTING
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseSetting(){
        return $this->belongsTo(BaseSetting::class , 'base_setting_id','base_setting_id');
    }


}