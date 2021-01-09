<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function Payment(Request $request){


        // if ($request->payment == 'card'){
        //     return 'card';
        // } elseif ($request->payment == 'paypal'){
        //     return 'paypal';
        // } elseif ($request->payment == 'bank') {
        //     return 'bank';
        // } elseif ($request->payment == 'cash') {
        //     return 'cash';
        // } else {
        //     return 'please select one payment method';
        // }

        $shipping = new Shipping;
        $shipping->user_id = Auth::id();
        $shipping->first_name = $request->first_name;
        $shipping->last_name = $request->last_name;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone; 
        $shipping->city_id = $request->city_id;
        $shipping->company = $request->company;
        $shipping->address = $request->address;
        $shipping->zipcode = $request->zipcode;
        $shipping->note = $request->note;
        // $shipping->status = $request->status;
        // $shipping->payment_status = $request->payment_status;
        $shipping->coupon_code = $request->coupon_code; 
        $shipping->save();
        
        
        $cookie = Cookie::get('cookie_id');
        $carts = Cart::where('cookie_id', $cookie)->get();

        foreach ($carts as $cart) {
            $order = new Order;
            $order->shipping_id = $shipping->id;
            $order->product_id = $cart->product_id;
            $order->product_unit_price = $cart->product->price;
            $order->quantity = $cart->quantity;
            $order->save();

            $cart->delete();
        }
        
    }
}
