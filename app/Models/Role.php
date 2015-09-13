<?php

namespace App\Models;


class Role extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection  = 'roles';

    /**
     * The fields who are mass assignable
     *
     * @var string
     */
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }


}
