<?php

namespace App\Repositories;

use App\Group;
use App\Product;

class ProductRepository extends BaseRepository {

    protected $groupRepository;

    public function __construct(Product $product, GroupRepository $groupRepository) {
        $this->model = $product;
        $this->groupRepository = $groupRepository;
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
        $product = $this->getById($id);
        return $this->save($product, $inputs);
    }

    /**
     * @param $product
     * @param $inputs
     * @return mixed
     */
    protected function save($product, $inputs) {
        $product->group_id = $inputs['group_id'];
        $product->name = $inputs['name'];
        $product->price = $inputs['price'];
        $product->quantity = $inputs['quantity'];
        if($inputs['discount']) {
            $product->discount = $inputs['discount'];
            if($inputs['discount'] < 100) {
                $product->total_price = $inputs['price'] / 100 * (100 - $inputs['discount']);
            }
            else {
                $product->total_price = $inputs['price'] - $inputs['discount'];
            }
        }
        $product->save();
        return $product;
    }

    public function getProductsOrderBy($group_id = null, $orderBy = 'created_at', $direction = 'Asc') {
        $query = $this->model->all();
        if($group_id) {
            $query = $query->where('group_id', '=', $group_id);
        }
        if($direction === 'Desc') {
            $query = $query->sortByDesc($orderBy);
        }
        else {
            $query = $query->sortBy($orderBy);
        }

        return $query;
    }

    public function count($group = null) {
        if($group) {
            return $this->model->where('group_id', '=', $group)->count();
        }
        return $this->model->count();
    }

    public function counts() {
        $groups = $this->groupRepository->all();
        $counts = [];
        foreach ($groups as $group) {
            $counts = array_add($counts, $group->id, $this->count($group->id));
        }
        $counts = array_add($counts, 'total', $this->count());
        return $counts;
    }
}