<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Checkout view
     */
    function Checkout(){
        $cookie = Cookie::get('cookie_id');
        $carts = Cart::where('cookie_id', $cookie)->get();
        $countries = Country::orderBy('name', 'asc')->get();

        return view('frontend.checkout',
            [
                'carts' => $carts,
                'countries' => $countries
            ]
        );
    }
    /**
     * Get State 
     */
    function GetState($country_id){
        $state = State::where('country_id', $country_id)->get();
        return response()->json($state);
    }
    /**
     * Get City
     */
    function GetCity($cities){
        $city = City::where('state_id', $cities)->get();

        return response()->json($city);
    }
    
}
