<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('frontend.checkout');
    }
}
