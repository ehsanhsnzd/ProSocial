<?php

namespace social\profile\app\Models;



use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Album;
use social\company\app\Models\CompanyRoom;
use social\core\app\Models\SocialModel;


class Post extends SocialModel
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'post_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['title','description','album_id','user_id' ,'company_id','company_room_id','is_active','created_at' ,'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Profiles
     */
    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function albums()
    {
        return $this->belongsTo(Album::class,'album_id','album_id');
    }

    public function room()
    {
        return $this->belongsTo(CompanyRoom::class,'company_room_id','company_room_id');
    }
}