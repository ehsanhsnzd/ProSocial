<?php
/**
 * Created by PhpStorm.
 * User: a.izadi
 * Date: 08/01/2019
 * Time: 03:07 PM
 */

namespace social\core\app\builder;



use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Support\Facades\Schema;

class SocialBuilder extends Builder
{

    private $table = '';

    public function __construct( ConnectionInterface $connection, $sTable = "", Grammar $grammar = null, Processor $processor = null ){

        $this->table = $sTable;

        parent::__construct($connection, $grammar, $processor);
    }

    public function get($columns =['*'],$CheckActive=true,$IsActive=true)
    {

        if ($CheckActive) {

            if(Schema::hasColumn($this->table, 'is_active'))
            {
                $this->where('is_active', $IsActive);
            }
        }
       return parent::get($columns);

    }



}