<?php

namespace social\company\app\Models;

use Illuminate\Database\Eloquent\Model;


class CompanyRoom extends Model
{

    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'company_rooms';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'company_room_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get company
     */

    protected $fillable = ['title','is_active','created_at' ,'updated_at'];



}
