<?php

namespace social\metadata\app\Models;

use Illuminate\Database\Eloquent\Model;
use social\profile\app\Models\Profile;

class MetaInfo extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'meta_infos';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'meta_info_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Profiles
     */
    public function metadata()
    {
        return $this->belongsTo(MetaDatas::class,'meta_data_id','meta_data_id');
    }
}