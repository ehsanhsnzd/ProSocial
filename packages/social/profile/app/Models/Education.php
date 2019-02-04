<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Album;
use social\core\app\Models\Setting;
use social\metadata\app\Models\MetaDatas;

class Education extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'educations';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'education_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['school','degree_id','from_id','to_id' ,'profile_id','album_id','meta_data_id','field','grade','activity' ,'description','is_active','created_at' ,'updated_at'];


    public function degree(){
        return $this->belongsTo(Setting::class,'degree_id','setting_id');
    }

    public function from_setting(){
        return $this->belongsTo(Setting::class,'from_id','setting_id');
    }

    public function to_setting(){
        return $this->belongsTo(Setting::class,'to_id','setting_id');
    }

    public function album(){
        return $this->belongsTo(Album::class,'album_id','album_id');
    }

    public function meta_data(){
        return $this->belongsTo(MetaDatas::class,'meta_data_id','meta_data_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Profiles
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
