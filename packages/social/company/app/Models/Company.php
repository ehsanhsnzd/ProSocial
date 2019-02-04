<?php

namespace social\company\app\Models;



use App\User;
use Illuminate\Database\Eloquent\Model;
use social\datas\app\Models\Project;
use social\datas\app\Models\Skill;
use social\profile\app\Models\Job;

class Company extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'company_id';

    /**
     * TABLES PROFILES
     *
     * @var array
     */
    protected $fillable = ['company_size_id','image_id','album_id','company_type_id','meta_data_id','category_id','title','page_name','website','description','is_active','created_at' ,'updated_at'];




    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get Jobs
     */
    public function jobs(){
        return $this->hasMany(Job::class,'job_id','job_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get Services or Products
     */
    public function services()
    {
        return $this->hasMany(Service::class,'company_id','company_id');
    }

    public function rooms()
    {
        return $this->hasMany(CompanyRoom::class,'company_id','company_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Skills
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class,'companies_skills','company_id','skill_id');
    }


    public function projects()
    {
        return $this->belongsToMany(project::class,'companies_projects','company_id','project_id');
    }



    public function follows()
    {
        return $this->belongsToMany(User::class,'follows','company_id','id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'company_id','company_id');
    }

    public function needs()
    {
        return $this->hasmany(Need::class,'company_id','company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function CompanyAdmin()
    {
        return $this->belongsToMany(User::class,'companies_admins','company_id','user_id');

    }
}