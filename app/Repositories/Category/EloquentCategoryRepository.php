<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentActivateTrait;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Model;


class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepositoryInterface
{
    use EloquentActivateTrait;

    protected $category;

    public function __construct(Model $category)
    {
        parent::__construct($category);
        $this->category = $category;
    }

}