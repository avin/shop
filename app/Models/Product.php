<?php

namespace App\Models;


class Product extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection  = 'products';

    /**
     * The fields who are mass assignable
     *
     * @var string
     */
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

}
