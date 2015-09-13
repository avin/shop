<?php

namespace App\Repositories\Product;

use App\Models\Review;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\EloquentActivateTrait;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class EloquentProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    use EloquentActivateTrait;

    protected $product;
    protected $review;
    protected $categoryRepository;
    protected $userRepository;

    public function __construct(Model $product, Model $review, CategoryRepositoryInterface $categoryRepository, UserRepositoryInterface $userRepository)
    {
        parent::__construct($product);
        $this->product = $product;
        $this->review = $review;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new product
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data)
    {
        $category_ids = array_get($data, 'category_ids', []);
        unset($data['category_ids']);

        $product = $this->model->create($data);
        if (!$product) {
            return false;
        }

        $product->categories()->sync($category_ids);

        return $product;
    }

    /**
     * Update a product
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function update($product, array $data)
    {
        $category_ids = array_get($data, 'category_ids', []);
        unset($data['category_ids']);

        $product->fill($data);

        $product->categories()->sync($category_ids);

        return $product->save();
    }

    /**
     * Update a product
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function createReview($product, array $reviewData)
    {
        $review = new $this->review($reviewData);
        return $product->reviews()->save($review);
    }
}