<?php

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository {

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        return $this->model = $user;
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
        $user = $this->getById($id);
        return $this->save($user, $inputs);
    }

    /**
     * @param $user
     * @param $inputs
     * @return mixed
     */
    protected function save($user, $inputs) {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->password = bcrypt($inputs['password']);
        $user->isAdmin = $inputs['isAdmin'];
        $user->seen = $inputs['seen'];
        $user->save();
        return $user;
    }
}