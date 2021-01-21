<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Shipping;
use App\Attribute;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    function Payment(Request $request){

        $order = Order::where('shipping_id', 9)->get();
        Mail::to(Auth::user()->email)->send(new OrderShipped($order));

        // return $request->all();
    
        if ($request->payment == 'card'){
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

                $attr = Attribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id);
                if ( $attr->exists()) {
                    $attr->decrement('quantity', $cart->quantity);
                }
                

                $cart->delete();
            }

            //Card Payment
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Mostakimul Karim." 
            ]);
            
            $payment_Update = Shipping::findOrFail( $shipping->id );
            $payment_Update->payment_status = 1;
            $payment_Update->save();
            return 'Payment Recieved Successfully!!!';

        } 
        elseif ($request->payment == 'paypal'){
            return 'paypal';
        } elseif ($request->payment == 'bank') {
            return 'bank';
        } elseif ($request->payment == 'cash') {
            return 'cash';
        } else {
            return 'please select one payment method';
        }
        
    }
}
