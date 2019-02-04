<?php

namespace social\metadata\app\Models;

use Illuminate\Database\Eloquent\Model;
use social\profile\app\Models\Profile;

class MetaDatas extends Model
{


    /**
     * TABLE NAME
     *
     * @var string
     */
    protected $table = 'meta_datas';

    /**
     * PRIMARY KEY NAME
     *
     * @var string
     */
    protected $primaryKey = 'meta_data_id';

    /**
     * TABLES ITEMS
     *
     * @var array
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get Profiles
     */


    public function metainfo()
    {
        return $this->belongsTo(MetaInfo::class,'meta_info_id','meta_info_id');
    }
}