<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 4:48 PM
 */
namespace social\album\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'image_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['album_id','user_id','address','is_active','is_trash','created_at' ,'updated_at'];

    /**
     * RETURN ALBUM
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album(){
        return $this->belongsTo(Album::class,'album_id','album_id');
    }


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}