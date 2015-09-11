<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Model as Eloquent;

class BaseModel extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}