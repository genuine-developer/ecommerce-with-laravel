<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    function Attribute(){
        return $this->hasMany(Attribute::class, 'color_id');
    }

    function cart(){
        return $this->hasMany(Cart::class, 'color_id');
    }
}
