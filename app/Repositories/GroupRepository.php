<?php

namespace App\Repositories;

use App\Group;

class GroupRepository extends BaseRepository {

    /**
     * GroupRepository constructor.
     * @param Group $group
     */
    public function __construct(Group $group) {
        $this->model = $group;
    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function store($inputs) {
        return $this->save(new $this->model, $inputs);
    }

    /**
     * @param $id
     * @param $inputs
     * @return mixed
     */
    public function update($id, $inputs) {
        $group = $this->getById($id);
        return $this->save($group, $inputs);
    }

    /**
     * @param $group
     * @param $inputs
     * @return mixed
     */
    protected function save($group, $inputs) {
        $group->name = $inputs['name'];
        $group->nameRU = $inputs['nameRU'];
        $group->save();
        return $group;
    }
}