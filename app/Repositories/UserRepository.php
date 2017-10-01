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

    public function count($seen = null, $admin = null) {
        if($seen) {
            return $this->model->where('seen', '=', $seen)->count();
        }
        if($admin) {
            return $this->model->where('isAdmin', '=', $admin)->count();
        }
        return $this->model->count();
    }

    public function counts() {
        $counts = [];
        $counts = array_add($counts, 'seen', $this->count(1));
        $counts = array_add($counts, 'total', $this->count());
        $counts = array_add($counts, 'admin', $this->count(null, 1));
        return $counts;
    }

    public function getUsersSortBy($sortBy = null, $nmbPage = 10) {
        if($sortBy == 'new') {
            $query = $this->model->where('seen', '=', 0);
            return $query->paginate($nmbPage);
        }
        if($sortBy == 'admin') {
            $query = $this->model->where('isAdmin', '=', 1);
            return $query->paginate($nmbPage);
        }
        $query = $this->model;
        return $query->paginate($nmbPage);
    }

    public function changeUserSeen($id) {
        $user = $this->getById($id);
        if($user->seen)
            $user->seen = 0;
        else
            $user->seen = 1;
        $user->save();
    }

    public function changeUserAdmin($id) {
        $user = $this->getById($id);
        if($user->isAdmin)
            $user->isAdmin = 0;
        else
            $user->isAdmin = 1;
        $user->save();
    }
}