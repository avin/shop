<?php

namespace App\Models;


class Category extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection  = 'categories';

    /**
     * The fields who are mass assignable
     *
     * @var string
     */
    protected $guarded = [];

}
