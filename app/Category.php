<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name', 'slug'
    ];

    function get_subcategory(){
        //return $this->hasMany('App\SubCategory', 'category_id');
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    function product(){
        return $this->hasMany(Product::class, 'category_id');
    }

    function blog(){
        return $this->hasMany(Blog::class, 'category_id');
    }
}
