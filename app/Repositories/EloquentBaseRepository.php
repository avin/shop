<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;

abstract class EloquentBaseRepository
{
    /**
     * Eloquent model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
        \DB::enableQueryLog();
    }

    /**
     * Count of all elements
     * @return object  collection of object of model
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     *
     * @return object  collection of object of model
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Destroy
     *
     * @return object  collection of object of model
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Create a new model
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data)
    {
        $model = $this->model->create($data);
        if (!$model) {
            return false;
        }
        return $model;
    }

    /**
     * Get single model by slug
     *
     * @param string slug
     * @return object object of model
     */
    public function byId($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get single model by slug
     *
     * @param string slug
     * @return object object of model
     */
    public function byIdWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    /**
     * Update model
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function update($model, array $data)
    {
        $model->fill($data);
        return $model->save();
    }

    /**
     * Restore trashed model
     * @param $model
     * @return bool
     */
    public function restore($model)
    {
        if ($model->restore()){
            return true;
        }
        return false;
    }

    public function initQuery(){
        return $this->model;
    }

    /**
     * Generate query to search by regexp string
     * @param $query
     * @param $searchValue
     * @return mixed
     */
    public function queryRegexSearch($query, $searchValue, $where="name"){
        if ($searchValue = trim($searchValue)){
            $searchValue = preg_replace('/\s+/', '.+', $searchValue);
            return $query->where($where,'like', "%$searchValue%");
        }

        return $query;
    }

    /**
     * Generate query to sort
     * @param $query
     * @param $propertyName
     * @param $sortType
     * @return mixed
     */
    public function queryOrderBy($query, $propertyName, $sortType){
        $query = $query->orderBy($propertyName, $sortType);

        return $query;
    }

    /**
     * Generate query to search by some attributes
     * @param array $attributes
     * @return mixed
     */
    public function queryByAttributes(array $attributes){
        $query = $this->model;

        // If has "search" attribute
        if ($searchValue = array_get($attributes, 'search')){
            $query = $this->queryRegexSearch($query, $searchValue);
        }

        // Get trashed elements
        if(array_get($attributes, 'show_trashed')) {
            $query = $query->withTrashed();
        }

        // Sort by name
        $query = $this->queryOrderBy($query, 'name', 'asc');

        return $query;
    }

    /**
     * Get elements
     * @param array $attributes
     * @param int $perPage
     * @param int $page
     * @return \StdClass
     * @internal param int $limit
     * @internal param array $filter
     */
    public function get($attributes = [], $perPage = 20, $page = 0)
    {
        // Set pagination page manually
        if ($page){
            Paginator::currentPageResolver(function() use ($page) {
                return $page;
            });
        }

        // Generate query
        $query = $this->queryByAttributes($attributes);

        // If limit exist - use it
        if($limitAttribute = array_get($attributes, 'limit', 0)){
            $perPage = intval($limitAttribute);
        }

        // Execute query
        return $query->paginate($perPage);
    }

}