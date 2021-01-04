<?php

namespace App\Http\Controllers;
use App\Attribute;
use App\Brand;
use App\Color;
use App\Size;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
        /**
     * Add Brand name
     */
    function AddBrand(){
        return view('backend.product.attributes.brand-add');
    }
    function AddBrandPost(Request $request){
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name);
        $brand->save();

        return back()->with('add_brand', 'New Brand Added Successfully!!!');
    }
    /**
     * Add Color
     */
    function AddColor(){
        return view('backend.product.attributes.color-add');
    }
    function AddColorPost(Request $request){
        $color = new Color;
        $color->color_name = $request->color_name;
        $color->slug = Str::slug($request->color_name);
        $color->save();

        return back()->with('add_color', 'New Color Added Successfully!!!');
    }

    /**
     * Add Sizes
     */
    function AddSize(){
        return view('backend.product.attributes.size-add');
    }
    function AddSizePost(Request $request){
        $size = new Size;
        $size->size_name = $request->size_name;
        $size->slug = Str::slug($request->size_name);
        $size->save();

        return back()->with('add_size', 'New Size Added Successfully!!!');
    }
}
