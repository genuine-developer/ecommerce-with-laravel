<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Gallery;
use App\Product;
use App\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Front(){

        $products = Product::latest()->limit(5)->get();

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

        $Attributes = Attribute::where('product_id', $product->id)->get();
        $collection = collect($Attributes);
        $groupBy = $collection->groupBy('color_id');
        return view('frontend.single-product',
            [
                'product' => $product,
                'gallery' => $gallery,
                'Attributes' => $Attributes,
                'groupBy'=> $groupBy
            ]
        );
    }

    /**
     * GEt Size Ajax
     */
    function GetSize($color, $product){
        $output = '';
        
        $sizes = Attribute::where('color_id', $color)->where('product_id', $product)->get();
        foreach ($sizes as $size) {
            $output = $output.' <input name="size_id" type="radio" value="'.$size->size_id.'"> '.$size->Size->size_name.'';
        }
        return $output;
    }
}
