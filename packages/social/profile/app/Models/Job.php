<?php

namespace social\profile\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\album\app\Models\Album;
use social\company\app\Models\Company;
use social\core\app\Models\Setting;

class Job extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'job_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */
    protected $fillable = ['title','job_type_id','job_from_id','job_to_id' ,'company_id','city_id','user_id','headline','description','company_name' ,'album_id','currently','is_active','created_at' ,'updated_at'];




    public function type(){
        return $this->belongsTo(Setting::class,'job_type_id','setting_id');
    }

    public function from_setting(){
        return $this->belongsTo(Setting::class,'job_from_id','setting_id');
    }

    public function to_setting(){
        return $this->belongsTo(Setting::class,'job_to_id','setting_id');
    }

    public function city(){
        return $this->belongsTo(Setting::class,'city_id','setting_id');
    }

    public function album(){
        return $this->belongsTo(Album::class,'album_id','album_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get profiles
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Company
     */

    public function company(){
        return $this->belongsTo(Company::class,'company_id','company_id');
    }

}
