<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Album;
use social\core\app\Models\Setting;

class Message extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'message_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['profile_from_id','profile_to_id','album_id','message' ,'created_at' ,'updated_at'];



    public function albums(){
        return $this->belongsTo(Album::class,'album_id','album_id');
    }

}