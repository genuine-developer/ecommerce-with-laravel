<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Coupon List view
     */
    function CouponList(){
        return view('backend.coupon.coupon-list');
    }
    /**
     * Coupon Add view
     */
    function CouponAdd(){
        return view('backend.coupon.add-coupon');
    }
    /**
     * Coupon Store
     */
    function CouponStore(Request $response){
        return $response;
    }

    /**
     * Delete Coupon
     */
    function CouponDelete(){
        return "ok";
    }

    /**
     * Apply Coupon
     */
    function ApplyCoupon(Request $request){

        


        return $request;
    }
}
