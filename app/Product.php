<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function group() {
        return $this->belongsTo('App\Group','id','group_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'product_id', 'id');
    }
}
