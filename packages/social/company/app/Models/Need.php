<?php

namespace social\company\app\Models;


use Illuminate\Database\Eloquent\Model;
use social\datas\app\Models\Skill;

class Need extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'needs';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'need_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     * Get Companies
     */

    protected $fillable = ['company_id','dependency','title','description','is_active','created_at' ,'updated_at'];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','company_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'needs_skills','need_id','skill_id');
    }


}