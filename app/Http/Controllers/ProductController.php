<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Brand;
use App\Category;
use App\Color;
use App\Gallery;
use App\Product;
use App\Size;
use App\SubCategory;
use Illuminate\Http\Request;
// use Image;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    /**
     * Product list show
     */
    function Products()
    {
        $products = Product::paginate();
        $product_count = Product::count();
        // $attribute = Attribute::where('product_id', $products->id)->get();

        return view('backend.product.product-list',
            [
                'products' => $products,
                'product_count' => $product_count,
                // 'attribute' => $attribute,
            ]
        );
    }

    /**
     * Product Add Form View
     */
    function ProductAdd(){
        
        $categories = Category::orderBy('category_name', 'asc')->get();
        $scat = SubCategory::orderBy('subcategory_name', 'asc')->get();
        $brand = Brand::orderBy('brand_name', 'asc')->get();
        $size = Size::orderBy('size_name', 'asc')->get();
        $color = Color::orderBy('color_name', 'asc')->get();

        return view('backend.product.product-add',
            [
                'categories' => $categories,
                'scat' => $scat,
                'brand' => $brand,
                'size' => $size,
                'color' => $color,
            ]
        );
    }

    /**
     * Product Add post
     */
    function ProductPost(Request $req){

        // Product::insert([
        //     'title' => $req->title
        // ]);
        
        //return $req->all();

        if ($req->hasFile('thumbnail')) {
            
            $image = $req->file('thumbnail');
            $ext = Str::random(5).'.'.$image->getClientOriginalExtension();
            $prod = new Product;

            $thumbnail_location = 'thumbnail/'
            . Carbon::now()->format('Y/m/')
            .'/';
            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);
            //save Image to the thumbnail path
            Image::make($image)->save(public_path($thumbnail_location.$ext));
            
            
            $prod->title = $req->title;
            $prod->slug = Str::slug($req->title);
            $prod->category_id = $req->category_id;
            $prod->subcategory_id = $req->subcategory_id;
            $prod->brand_id = $req->brand_id;
            $prod->price = $req->price;
            $prod->summary = $req->summary;
            $prod->description = $req->description;
            $prod->thumbnail = $ext;
            $prod->save();

           
            
            foreach ($req->color_id as $key => $value) {
                $attribute = new Attribute;
                $attribute->product_id = $prod->id;
                $attribute->size_id = $req->size_id[$key];
                $attribute->color_id = $value;
                $attribute->quantity = $req->quantity[$key];
                $attribute->save();
            }


            if($req->hasFile('images')){

                $images = $req->file('images');
    
                $new_location = 'gallery/'
                    . Carbon::now()->format('Y/m/')
                    . $prod->id .'/';

                File::makeDirectory($new_location, $mode=0777, true, true);
    
                foreach ($images as $img) {
                    $img_ext = Str::random(5).'.'.$img->getClientOriginalExtension();
                    Image::make($img)->save(public_path($new_location. $img_ext));
    
                    // Gallery::insert([
                    //     'product_id' => $prod->id,
                    //     'images' => $img_ext,
                    //     'created_at' => Carbon::now()
                    // ]);
    
                    $gallery = new Gallery;
                    $gallery->product_id = $prod->id;
                    $gallery->images = $img_ext;
                    $gallery->save();
                }
                
            }
    
    
            return back()->with('product_add', 'Product Added Successfully!!!');
            
        }
    }


    /**
     * Product Edit
     */
    function ProductEdit($slug){

        return view('backend.product.product-edit',
            [
                'brand' => Brand::all(),
                'categories' => Category::all(),
                //'scat' => SubCategory::all(),
                'product' => Product::where('slug', $slug)->first()
            ]
        );
    }

    /**
     * Update Action
     */
    function ProductUpdate(Request $req){

        $prod = Product::findOrFail($req->product_id);

        if($req->hasFile('thumbnail')){

            $image = $req->file('thumbnail');
            $ext = Str::random(5).'.'.$image->getClientOriginalExtension();

            $old_img_location = public_path('thumbnail/'.$prod->created_at->format('Y/m/').$prod->id.'/'.$prod->thumbnail);
            //Delete previous Image
            if(file_exists($old_img_location)){

                unlink($old_img_location);
            }
            //Thumbnail location
            $thumbnail_location = 'thumbnail/'
            . Carbon::now()->format('Y/m/')
            .'/';
            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);
            //save Image to the thumbnail path
            Image::make($image)->save(public_path($thumbnail_location.$ext));

            $prod->thumbnail = $ext;
        }

        $prod->title = $req->title;
        $prod->slug = Str::slug($req->title);
        $prod->category_id = $req->category_id;
        $prod->subcategory_id = $req->subcategory_id;
        $prod->brand_id = $req->brand_id;
        $prod->price = $req->price;
        $prod->summary = $req->summary;
        $prod->description = $req->description;
        $prod->save();

        return redirect()->route('Products')->with('product_update', 'Product Updated Successfully!!!');
    }

    /**
     * Ajax For Update
     */
    function ProductUpdateAjax($id){
        $scat = SubCategory::where('category_id', $id)->get();

        return response()->json($scat);
    }


    /**
     * Gallery Update
     */
    function GalleryEdit($slug){

        $product_id = Product::where('slug', $slug)->first();
        $gallery = Gallery::where('product_id', $product_id->id)->get();

        return view('backend.product.product-gallery-edit',
            [
                'gallery' => $gallery,
                'product_id' => $product_id->id
            ]
        );

    }

    /**
     * Gallery Image Delete
     */
    function GalleryImageDelete($id){

        $gallery = Gallery::findOrFail($id);

        $img_path = public_path('gallery/'.$gallery->created_at->format('Y/m/').$gallery->product_id.'/'.$gallery->images);
  
        if(file_exists($img_path)){
            unlink($img_path);
            $gallery->delete();
        }

        return back()->with('ImageDelete', 'Image Deleted Successfully!!!');
    }

    /**
     * MultiImage Update
     */
    function MultiImageUpdate(Request $req){

        //$prod = new Product;

        if($req->hasFile('images')){

           
            $product_id = $req->product_id;
            $images = $req->file('images');

            $new_location = 'gallery/'
                . Carbon::now()->format('Y/m/')
                . $product_id .'/';

            File::makeDirectory($new_location, $mode=0777, true, true);

            foreach ($images as $img) {
                $img_ext = Str::random(5).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save(public_path($new_location. $img_ext));

                // Gallery::insert([
                //     'product_id' => $prod->id,
                //     'images' => $img_ext,
                //     'created_at' => Carbon::now()
                // ]);

                $gallery = new Gallery;
                $gallery->product_id = $product_id;
                $gallery->images = $img_ext;
                $gallery->save();
            }
            
            return back();
        }
    }

    /**
     * Product Delete
     */
    function ProductDelete($id){

        $product = Product::findOrFail($id);
        //Thumbnail Path
        $img_path = public_path('thumbnail/'.$product->created_at->format('Y/m/').'/'.$product->thumbnail);
  
        if(file_exists($img_path)){
            unlink($img_path);
        }
        
        $gallery = Gallery::where('product_id', $product->id)->get();
        //Gallery Image Delete
        foreach($gallery as $img){
            
            $old_path = public_path('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'.$img->images);
    
            if(file_exists($old_path)){
                unlink($old_path);
                $img->delete();
            }
        }

        $product->delete();

        return back()->with('ProductDelete', 'Product Deleted Successfully!!!');
        
    }
}
