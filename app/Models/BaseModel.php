<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Get name table by static model
     *
     * @return string
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
