<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Carbon\Carbon;
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
            return back();
        } else {
            $cart = new Cart;
            $cart->cookie_id = $unique;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();

            return back();
        }

        
    }

    /**
     * Cart Page view
     */
    function Cart(Request $request){


        $coupon_discount = 0;
        $coup_code = $request->coupon_code;

         if ($request->coupon_code == '') {

            $cookie = Cookie::get('cookie_id');
            
            return view('frontend.cart',
                [
                    'carts' => Cart::where('cookie_id', $cookie)->get(),
                    'coupon_discount' => $coupon_discount
                    
                ]
            );

         } else {

            $cookie = Cookie::get('cookie_id');
            $req_coupon = Coupon::where('code', $request->coupon_code)->exists(); 

            if ($req_coupon) {
                $carts = Cart::where('cookie_id', $cookie)->get();
                $valid_date = Coupon::where('code', $request->coupon_code)->first();
               
                if (Carbon::now()->format('Y-m-d') <= $valid_date->validity){

                    if ($valid_date->level == 'amount') {

                        $coupon_discount = $valid_date->discount;

                    } else {
                        $total = 0;
                        foreach($carts as $cart){
                            $total += $cart->product->price * $cart->quantity;
                        }
                        $coupon_discount = ($total / 100) * $valid_date->discount;
                    }
                } else {
                    return back()->with('coupon_invalid', 'Coupon Code Expired!!!');
                }

            } else {
                return back()->with('coupon_exist', 'Coupon Code Does not exist!!!');
            }

            return view('frontend.cart',
                [
                    'carts' => Cart::where('cookie_id', $cookie)->get(),
                    'coupon_discount' => $coupon_discount,
                    'coup_code' => $coup_code
                ]
            );
         }
         

        
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

    /**
     * Single Cart delete
     */
    function SingleCartDelete($cartid){

        $cart = Cart::findOrFail($cartid);
        $cart->delete();
        return back();
    }


}
