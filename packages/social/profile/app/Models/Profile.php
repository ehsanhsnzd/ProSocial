<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Album;
use social\album\app\Models\Image;
use social\company\app\Models\CompanyRoom;
use social\core\app\Models\Setting;
use social\datas\app\Models\Project;
use social\datas\app\Models\Skill;

class Profile extends Model
{
    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'profile_id';

    /**
     * TABLES PROFILES
     *
     * @var array
     */
    protected $fillable = ['user_type','name','last_name','country_id','sate_id','city_id','username','zip','description','album_id','images_id','phone','address','email','is_active','created_at' ,'updated_at'];




    public function country(){
        return $this->belongsTo(Setting::class,'country_id','setting_id');
    }

    public function state(){
        return $this->belongsTo(Setting::class,'state_id','setting_id');
    }

    public function city(){
        return $this->belongsTo(Setting::class,'city_id','setting_id');
    }

    public function album(){
        return $this->belongsTo(Album::class,'album_id','album_id')->with('images');
    }

    public function image(){
        return $this->belongsTo(Image::class,'image_id','image_id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Profile hasone User
     */

    public function user_details(){
        return $this->belongsTo(User::class,'user_id','id')->with('profile','messengers','current_jobs','jobs','educations','skills','projects','image');
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }


}
