<?php

namespace App\Repositories;

trait EloquentActivateTrait
{
    /**
     * Activate model
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function activate($model)
    {
        $model->active = true;
        return $model->save();
    }

    /**
     * Deactivate model
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function deactivate($model)
    {
        $model->active = false;
        return $model->save();
    }

}