<?php

namespace social\datas\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\company\app\Models\Company;
use social\company\app\Models\Need;

class Skill extends Model
{



    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'skills';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'skill_id';

    /**
     * TABLES PROFILES
     *
     * @var array
     */
    protected $fillable = ['title','is_active','created_at' ,'updated_at'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Profiles
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'profiles_skills','skill_id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Companies
     */

    public function companies()
    {
        return $this->belongsToMany(Company::class,'companies_skills','skill_id','company_id');
    }


    public function needs()
    {
        return $this->belongsToMany(Need::class,'needs_skills','skill_id','need_id');
    }

}