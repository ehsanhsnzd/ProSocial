<?php

namespace social\datas\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use social\company\app\Models\Company;


class Project extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'project_id';

    /**
     * TABLES PROFILES
     *
     * @var array
     */
    protected $fillable = ['project_size_id','project_type_id','album_id','title','description','is_active','created_at' ,'updated_at'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Profiles
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'profiles_projects','project_id','user_id');
    }


    public function companies()
    {
        return $this->belongsToMany(Company::class,'companies_projects','project_id','company_id');
    }
}