<?php

namespace App\Models;


class Review extends BaseModel
{

    /**
     * The fields who are mass assignable
     *
     * @var string
     */
    protected $guarded = [];

    public function author(){
        return $this->embedsOne('App\Models\User');
    }

}
