<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 4:48 PM
 */
namespace social\core\app\Models;

use App\User;

class ResetPassword extends SocialModel{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'reset_passwords';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'reset_password_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['user_id','token','is_active','is_trash','created_at' ,'updated_at'];

    /**
     * GET PARENT User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class ,'user_id' ,'id');
    }




}