<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
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
     * Генерация запроса на поиск по регулярке (в имени!)
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
     * Генерация запроса на сортировку
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
     * Генерация запроса по поисковым атрибутам
     * @param array $attributes
     * @return mixed
     */
    public function queryByAttributes(array $attributes){
        $query = $this->model;

        //Если есть поисковая строка
        if ($searchValue = array_get($attributes, 'search')){
            $query = $this->queryRegexSearch($query, $searchValue);
        }

        //Включить также удаленные элементы
        if(array_get($attributes, 'show_trashed')) {
            $query = $query->withTrashed();
        }

        //Сортируем по имени
        $query = $this->queryOrderBy($query, 'name', 'asc');

        return $query;
    }

    /**
     * Получить шаблоны по указанным атрибутам
     * @param array $attributes
     * @param int $perPage
     * @param int $page
     * @return \StdClass
     * @internal param int $limit
     * @internal param array $filter
     */
    public function get($attributes = [], $perPage = 20, $page = 0)
    {
        // Выставить страницу пагинации вручную
        if ($page){
            Paginator::currentPageResolver(function() use ($page) {
                return $page;
            });
        }

        //Составить запрос
        $query = $this->queryByAttributes($attributes);

        //Если в атрибутах(!) указан лимит - применяем именно его!
        if($limitAttribute = array_get($attributes, 'limit', 0)){
            $perPage = intval($limitAttribute);
        }

        //Выполнить запрос с пагинацией
        return $query->paginate($perPage);
    }

}