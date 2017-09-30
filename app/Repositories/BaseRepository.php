<?php

namespace App\Repositories;

abstract class BaseRepository {
    protected $model;

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 10, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function getById($id, $columns = array('*')) {
        return $this->model->where('id', '=', $id)->first($columns);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }
}