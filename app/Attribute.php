<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    function Size(){
        return $this->belongsTo(Size::class, 'size_id');
    }

    function Color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
