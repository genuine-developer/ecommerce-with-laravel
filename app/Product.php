<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    function gallery(){
        return $this->hasMany(Gallery::class, 'product_id');
    }

    function attribute(){
        return $this->hasMany(Attribute::class, 'product_id');
    }

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    function cart(){
        return $this->hasMany(Cart::class, 'product_id');
    }
}
