<?php

namespace App\Repositories;

use App\Product;

class ProductRepository extends BaseRepository {

    public function __construct(Product $product) {
        $this->model = $product;
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
        $product->discount = $inputs['discount'];
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
}