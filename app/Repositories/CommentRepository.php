<?php

namespace App\Repositories;

use App\Comment;
use App\Product;
use App\User;

class CommentRepository extends BaseRepository {

    protected $product;
    protected $user;

    public function __construct(Comment $comment, Product $product, User $user) {
        $this->model = $comment;
        $this->product = $product;
        $this->user = $user;
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
        $comment = $this->getById($id);
        return $this->save($comment, $inputs);
    }

    /**
     * @param $comment
     * @param $inputs
     * @return mixed
     */
    protected function save($comment, $inputs) {
        $comment->text = $inputs['text'];
        $comment->user_id = $inputs['user_id'];
        $comment->product_id = $inputs['product_id'];
        $comment->seen = false;
        $comment->save();
        return $comment;
    }

    public function getAllCommentsByProductId($id) {
        return $this->model->where('product_id', '=', $id)->latest()->get();
    }
}