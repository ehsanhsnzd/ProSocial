<?php

namespace social\company\app\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'category_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     * Get Companies
     */
    protected $fillable = ['category_type_id','company_id','parent_id','title','is_active','created_at' ,'updated_at'];

    public function services()
    {
        return $this->hasMany(Service::class,'category_id','category_id');
    }

}