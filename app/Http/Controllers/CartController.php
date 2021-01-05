<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Add To Cart
     */
    function AddToCart(Request $request){
        
        $cookie = Cookie::get('cookie_id');

        if($cookie){
            $unique = $cookie;
        } else{
            $unique = Str::random(7).rand(1,1000);
            Cookie::queue('cookie_id', $unique, 43200);
        }
        $exist = Cart::where('cookie_id', $unique)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id);
        
        if($exist->exists()){
            $exist->increment('quantity', $request->quantity);
        } else {
            $cart = new Cart;
            $cart->cookie_id = $unique;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();
        }

        
    }

    /**
     * Cart Page view
     */
    function Cart(){

        $cookie = Cookie::get('cookie_id');

        return view('frontend.cart',
            [
                'carts' => Cart::where('cookie_id', $cookie)->get()
            ]
        );
    }

    /**
     * Cart Update
     */
    function CartUpdate(Request $request){
        foreach ($request->cart_id as $key => $data) {
            $cart = Cart::findOrFail($data);
            $cart->quantity = $request->quantity[$key];
            $cart->save();
        }
        return back();
    }
}
