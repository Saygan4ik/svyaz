<?php

namespace App\Repositories;

use App\Rating;

class RatingRepository extends BaseRepository {
    protected $productRepository;

    public function __construct(Rating $rating, ProductRepository $productRepository) {
        $this->model = $rating;
        $this->productRepository = $productRepository;
    }

    public function saveRating($productId, $userId, $value) {
        $product = $this->productRepository->getById($productId);
        $rating = $this->model->where([
            ['product_id', $productId],
            ['user_id', $userId]
        ])->get();
        if($rating->isEmpty()) {
            $rating = new $this->model;
            $rating->user_id = $userId;
            $rating->product_id = $productId;
            $rating->rating = $value;
            $product->quantityRating = $product->quantityRating + 1;
            $product->sumRating = $product->sumRating + $value;
        }
        else {
            $rating = $rating->first();
            $product->sumRating = $product->sumRating - $rating->rating + $value;
            $rating->rating = $value;
        }
        $rating->save();
        $product->save();
    }

    public function getRatingForProduct($productId, $userId) {
        $rating = $this->model->where([
            ['product_id', $productId],
            ['user_id', $userId]
        ])->get();
        return $rating;
    }
}