<?php

namespace social\company\app\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'service_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     * Get Companies
     */

    protected $fillable = ['service_type_id','company_id','category_id','title','description','price','is_active','created_at' ,'updated_at'];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','company_id');
    }


}