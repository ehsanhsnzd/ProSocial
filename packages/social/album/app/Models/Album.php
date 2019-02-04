<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 11/7/18
 * Time: 4:48 PM
 */
namespace social\album\app\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'albums';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'album_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['title','is_active','is_trash','created_at' ,'updated_at'];

    /**
     * RETURN IMAGES
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function images(){
        return $this->hasMany(Image::class,'album_id','album_id');
    }


}