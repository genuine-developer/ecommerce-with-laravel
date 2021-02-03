<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Blog;
use App\Category;
use App\Comment;
use App\Gallery;
use App\Product;
use App\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Shop Page View
     */
    function Shop(){
        return view('frontend.shop',
            [
                'category' => Category::orderBy('category_name', 'asc')->get(),
                'products' => Product::all()
            ]
        );
    }

    /**
     * Blog Functions
     */
    function Blogs(){

        $blogs = Blog::latest()->paginate(2);
        return view('frontend.blogs',
            [
                'blogs' => $blogs
            ]
        );
    }
    
    function SingleBlog($slug){

        $blog = Blog::whereSlug($slug)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('frontend.single-blog',
            [
                'blog' => $blog,
                'category' => $category,
                'related' => Blog::where('category_id', $blog->category_id)->get()->except(['id', $blog->id]),
                'comments' => Comment::where('status', 2)->latest()->get()
            ]
        );
    }

    
}
