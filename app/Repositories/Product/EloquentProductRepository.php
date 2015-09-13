<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentActivateTrait;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Model;


class EloquentProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    use EloquentActivateTrait;

    protected $product;

    public function __construct(Model $product)
    {
        parent::__construct($product);
        $this->product = $product;
    }

}