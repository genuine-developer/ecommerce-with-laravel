<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    function Attribute(){
        return $this->hasMany(Attribute::class, 'size_id');
    }

    function cart(){
        return $this->hasMany(Cart::class, 'size_id');
    }
}
