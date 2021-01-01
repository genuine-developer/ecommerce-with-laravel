<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Front(){

        $products = Product::latest()->limit(2)->get();

        return view('frontend.main',
            [
                'products' => $products,
            ]
        );
    }


    /**
     * SingleProduct Show
     */
    function SingleProduct($slug){

        $product = Product::where('slug', $slug)->first();
        $gallery = Gallery::where('product_id', $product->id)->get();

        return view('frontend.single-product',
            [
                'product' => $product,
                'gallery' => $gallery
            ]
        );
    }
}
