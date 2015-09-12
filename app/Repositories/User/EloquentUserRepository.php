<?php

namespace App\Repositories\User;

use App\Repositories\EloquentActivateTrait;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Model;


class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    use EloquentActivateTrait;

    protected $user;

    public function __construct(Model $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    /**
     * Update model
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function update($model, array $input)
    {
        // Except password if it's empty
        if (!$input['password']) {
            $input = array_except($input, array('password'));
        }
        $model->fill($input);
        return $model->save();
    }

    /**
     * Get total users count
     *
     * @return int Total users
     */
    protected function totalUsers()
    {
        return $this->user->count();
    }

    /**
     * Save user settings
     * @param $model
     * @param $settingName
     * @param $data
     * @return bool
     */
    public function saveSettings($model, $settingName, $data)
    {

        if (isset($model->settings)) {
            $settings = $model->settings;
        } else {
            $settings = [];
        }

        array_set($settings, $settingName, $data);

        $model->settings = $settings;

        if ($model->save()) {
            return $model;
        }
        return false;
    }


}