<?php

use App\Cart;
use Illuminate\Support\Facades\Cookie;

    function cart(){
        $cookie = Cookie::get('cookie_id');
        return Cart::where('cookie_id', $cookie)->get();
    }


?>